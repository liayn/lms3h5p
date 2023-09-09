<?php
/** @noinspection PhpUnhandledExceptionInspection */

namespace LMS3\Lms3h5p;

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

use TYPO3\CMS\Core\Core\Environment;
use LMS3\Lms3h5p\H5PAdapter\Core\FileAdapter;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * Setup
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class Setup
{
    private array $ts;

    public function __construct(ConfigurationManager $manager)
    {
        $this->ts = $manager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            'Lms3h5p',
            'Pi1'
        );
    }

    /**
     * Copy H5P libraries resources
     */
    public function copyResourcesFromH5PLibraries(): void
    {
        if (empty($this->ts)) {
            return;
        }

        $h5pLibraryPath = Environment::getProjectPath() . $this->ts['libraryPath'];

        if (!is_dir($h5pLibraryPath)) {
            return;
        }

        $coreSubfolders = ['fonts', 'images', 'js', 'styles'];
        $editorSubfolders = ['ckeditor', 'images', 'language', 'libs', 'scripts', 'styles'];

        $destinationBasePath = Environment::getPublicPath() . $this->ts['h5pPublicFolder']['path'];

        $destinationH5pCorePath = $destinationBasePath . $this->ts['subFolders']['core'];
        $destinationH5pEditorPath = $destinationBasePath . $this->ts['subFolders']['editor'];

        $sourceH5pCorePath = $h5pLibraryPath . $this->ts['subFolders']['core'];
        $sourceH5pEditorPath = $h5pLibraryPath . $this->ts['subFolders']['editor'];

        foreach ($coreSubfolders as $folder) {
            $destination = $destinationH5pCorePath . DIRECTORY_SEPARATOR . $folder;
            $source = $sourceH5pCorePath . DIRECTORY_SEPARATOR . $folder;
            FileAdapter::dirReady($destination);
            FileAdapter::copyFileTree($source, $destination);
        }

        foreach ($editorSubfolders as $folder) {
            $destination = $destinationH5pEditorPath . DIRECTORY_SEPARATOR . $folder;
            $source = $sourceH5pEditorPath . DIRECTORY_SEPARATOR . $folder;
            FileAdapter::dirReady($destination);
            FileAdapter::copyFileTree($source, $destination);
        }
    }
}
