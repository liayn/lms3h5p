<?php
declare(strict_types = 1);

namespace LMS3\Lms3h5p\Controller;

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
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Page\PageRenderer;
use LMS3\Lms3h5p\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Content Embed Controller
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class ContentEmbedController extends ActionController
{
    const LIST_TYPE = 'lms3h5p_pi1';

    /**
     * @var \LMS3\Lms3h5p\Service\H5PIntegrationService
     * @inject
     */
    protected $h5pIntegrationService;

    /**
     * @var \LMS3\Lms3h5p\Service\ContentService
     * @inject
     */
    protected $contentService;

    /**
     * Index action
     *
     * @return bool
     */
    public function indexAction()
    {
        $this->addScriptAndStyles();
        $contentId = (int) $this->settings['contentId'];
        if (empty($contentId)) {
            return false;
        }
        /** @var Content $content */
        $content = $this->contentService->findByUid($contentId);
        if (null === $content) {
            return false;
        }

        $this->view->assign('content', $content);
    }

    /**
     * Set content element scripts and styles
     */
    protected function addScriptAndStyles(): void
    {
        /** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder $queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tt_content');
        $query = $queryBuilder->select('pi_flexform')
            ->from('tt_content')
            ->where('list_type = "' . self::LIST_TYPE . '"')
            ->orderBy('sorting')
            ->execute();
        $h5pInstances = $query->fetchAll();
        if (0 === count($h5pInstances)) {
            return;
        }

        $ffs = GeneralUtility::makeInstance(FlexFormService::class);
        $contentIds = [];
        foreach ($h5pInstances as $instance) {
            $flex = $ffs->convertFlexFormContentToArray($instance['pi_flexform']);
            $contentIds[] = $flex['settings']['contentId'];
        }

        $h5pIntegrationSettings = $this->h5pIntegrationService->getH5PSettings($this->getControllerContext(), $contentIds);
        $mergedScripts = array_unique($this->h5pIntegrationService->getMergedScripts($h5pIntegrationSettings));
        $mergedStyles = array_unique($this->h5pIntegrationService->getMergedStyles($h5pIntegrationSettings));

        self::getPageRenderer()->addJsInlineCode('H5PSettings',
            'window.H5PIntegration = ' . json_encode($h5pIntegrationSettings) . ';'
        );
        /**
         * Add H5P CSS files
         */
        foreach ($mergedStyles as $style) {
            self::getPageRenderer()->addCssFile(
                $style, 'stylesheet', 'all', '', false, false, '', true
            );
        }
        /**
         *  Add H5P javascript files
         */
        foreach ($mergedScripts as $script) {
            self::getPageRenderer()->addJsFile($script);
        }
    }

    /**
     * Get PageRenderer instance
     *
     * @return PageRenderer
     */
    protected static function getPageRenderer(): PageRenderer
    {
        return GeneralUtility::makeInstance(PageRenderer::class);
    }

}