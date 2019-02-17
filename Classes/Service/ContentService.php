<?php

namespace LMS3\Lms3h5p\Service;

/* * *************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2019 LEARNTUBE! GbR - Contact: mail@learntube.de
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

use LMS3\Lms3h5p\Domain\Model\Content;
use LMS3\Lms3h5p\Domain\Repository\ContentRepository;

/**
 * Content Service
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class ContentService
{
    /**
     * @var \H5PCore
     */
    protected $h5pCore;

    /**
     * @var \H5peditor
     */
    protected $h5pEditor;

    /**
     * @var H5PIntegrationService
     */
    protected $h5pIntegrationService;

    /**
     * @var ContentRepository
     */
    protected $contentRepository;

    /**
     * @param H5PIntegrationService $h5PIntegrationService
     */
    public function injectH5PIntegrationService(H5PIntegrationService $h5PIntegrationService)
    {
        $this->h5pIntegrationService = $h5PIntegrationService;
    }

    /**
     * @param ContentRepository $contentRepository
     */
    public function injectContentRepository(ContentRepository $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    /**
     * Creates the content data structure that H5P expects and passes it into its API.
     * If a $contentId is provided, will try to find and update that content. If there
     * is no content with that ID, it will be created.
     *
     * @param string $library
     * @param string $parameters
     * @param int $contentId
     * @param array $options
     * @return null|Content
     */
    public function handleCreateOrUpdate(string $library, string $parameters, $contentId = null, $options = [])
    {
        $content = [];
        $oldLibrary = null;
        $oldParameters = null;

        // Before we save the new data, load the old data from the DB.
        if ($contentId) {
            $content['id'] = $contentId;
            $contentObject = $this->contentRepository->findByUid($content['id']);

            if($contentObject !== null) {
                $oldLibrary = $contentObject->getLibrary()->toAssocArray();
                $oldParameters = json_decode($contentObject->getParameters());
            }
        }

        $this->h5pCore = $this->h5pIntegrationService->getH5PCoreInstance();
        $this->h5pEditor = $this->h5pIntegrationService->getH5pEditor();

        $disable = $this->getDisabledContentFeatures($this->h5pCore, $options);

        $params = json_decode($parameters);
        if ($params === NULL) {
            $this->h5pCore->h5pF->setErrorMessage('Invalid parameters.');
            return null;
        }

        // Trim title and check length
        $trimmed_title = empty($params->metadata) ? '' : trim($params->metadata->title);
        if ($trimmed_title === '') {
            $this->h5pCore->h5pF->setErrorMessage('Missing title.');
            return null;
        }

        $content['disable'] = $disable;
        $content['title'] = $trimmed_title;
        $content['params'] = json_encode($params->params);
        $content['metadata'] = $params->metadata;

        // Get library
        $content['library'] = $this->h5pCore->libraryFromString($library);
        if (!$content['library']) {
            $this->h5pCore->h5pF->setErrorMessage('Invalid library.');
            return null;
        }

        // Check if library exists.
        $content['library']['libraryId'] = $this->h5pCore->h5pF->getLibraryId(
            $content['library']['machineName'],
            $content['library']['majorVersion'],
            $content['library']['minorVersion']
        );
        if (!$content['library']['libraryId']) {
            $this->h5pCore->h5pF->setErrorMessage('No such library.');
            return null;
        }

        $content['id'] = $this->h5pCore->saveContent($content);
        if (!$content['library']['libraryId']) {
            $this->h5pCore->h5pF->setErrorMessage('No such library.');
            return null;
        }

        $this->h5pEditor->processParameters($content['id'], $content['library'], $params, $oldLibrary, $oldParameters);
        $contentObject = $this->contentRepository->findByUid($content['id']);

        /** @var Content $contentObject */
        $content = $contentObject->toAssocArray();
        $content['slug'] = '';
        $this->h5pCore->filterParameters($content);

        return $this->contentRepository->findByUid($content['id']);
    }

    /**
     * Delete content
     *
     * @param Content $content
     */
    public function handleDelete(Content $content)
    {
        $h5pCoreInstance = $this->h5pIntegrationService->getH5PCoreInstance();
        $h5pStorage = new \H5PStorage($h5pCoreInstance->h5pF, $h5pCoreInstance);
        $h5pStorage->deletePackage($content->toAssocArray());
    }

    /**
     * Find all content records
     *
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findAll()
    {
        return $this->contentRepository->findAll();
    }

    /**
     * Content
     *
     * @param int $uid
     * @return Content
     */
    public function findByUid(int $uid)
    {
        $this->contentRepository->setDefaultQuerySettings(
            $this->contentRepository->createQuery()->getQuerySettings()->setRespectStoragePage(false)
        );

        return $this->contentRepository->findByUid($uid);
    }

    /**
     * Get disabled content features
     *
     * @param \H5PCore $core
     * @param array $options
     * @return int
     */
    protected function getDisabledContentFeatures(\H5PCore $core, array $options)
    {
        $set = array(
            \H5PCore::DISPLAY_OPTION_FRAME => (bool) $options['frame'],
            \H5PCore::DISPLAY_OPTION_DOWNLOAD => (bool) $options['download'],
            \H5PCore::DISPLAY_OPTION_EMBED => (bool) $options['embed'],
            \H5PCore::DISPLAY_OPTION_COPYRIGHT => (bool) $options['copyright'],
        );

        return $core->getStorableDisplayOptions($set, \H5PCore::DISABLE_NONE);
    }
}