<?php

namespace LMS3\Lms3h5p\H5PAdapter\Editor;

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

use LMS3\Lms3h5p\Domain\Model\Library;
use LMS3\Lms3h5p\Domain\Repository\ContentTypeCacheEntryRepository;
use LMS3\Lms3h5p\Domain\Repository\LibraryRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Editor Ajax
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class EditorAjax implements \H5PEditorAjaxInterface
{
    /**
     * @var LibraryRepository
     */
    protected $libraryRepository;

    /**
     * @var \LMS3\Lms3h5p\Domain\Repository\ContentTypeCacheEntryRepository
     */
    protected $contentTypeCacheEntryRepository;

    /**
     * EditorAjax constructor.
     */
    public function __construct()
    {
        $this->libraryRepository = GeneralUtility::makeInstance(LibraryRepository::class);
        $this->contentTypeCacheEntryRepository = GeneralUtility::makeInstance(
            ContentTypeCacheEntryRepository::class
        );
    }

    /**
     * Gets latest library versions that exists locally
     *
     * @return array Latest version of all local libraries
     */
    public function getLatestLibraryVersions()
    {
        $librariesOrderedByMajorAndMinorVersion = $this->libraryRepository->findLatestLibraryVersions();

        $versionInformation = [];
        /** @var Library $library */
        foreach ($librariesOrderedByMajorAndMinorVersion as $library) {
            $versionInformation[] = (object)$library;
        }

        return $versionInformation;
    }

    /**
     * Get locally stored Content Type Cache. If machine name is provided
     * it will only get the given content type from the cache
     *
     * @param $machineName
     *
     * @return array|object|null Returns results from querying the database
     */
    public function getContentTypeCache($machineName = NULL)
    {
        if ($machineName != null) {
            return $this->contentTypeCacheEntryRepository->findOneByMachineName($machineName);
        }

        return $this->contentTypeCacheEntryRepository->getContentTypeCacheObjects();
    }

    /**
     * Gets recently used libraries for the current author
     *
     * @return array machine names. The first element in the array is the
     * most recently used.
     */
    public function getAuthorsRecentlyUsedLibraries()
    {
        // TODO: Implement getAuthorsRecentlyUsedLibraries() method.
    }

    /**
     * Checks if the provided token is valid for this endpoint
     *
     * @param string $token The token that will be validated for.
     *
     * @return bool True if successful validation
     */
    public function validateEditorToken($token)
    {
        // TODO: Implement validateEditorToken() method.
        return true;
    }

    /**
     * Get translations for a language for a list of libraries
     *
     * @param array $libraries An array of libraries, in the form "<machineName> <majorVersion>.<minorVersion>
     * @param string $language_code
     * @return array
     */
    public function getTranslations($libraries, $language_code)
    {
        // TODO: Implement getTranslations() method.
    }
}