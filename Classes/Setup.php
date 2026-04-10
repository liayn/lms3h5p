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

    /**
     * Default settings used as fallback when TypoScript is not available (e.g. CLI context)
     */
    private const DEFAULT_SETTINGS = [
        'h5pPublicFolder' => [
            'url' => '/fileadmin/h5p/',
            'path' => '/fileadmin/h5p/',
        ],
        'subFolders' => [
            'content' => 'content',
            'libraries' => 'libraries',
            'core' => 'h5p-core',
            'editor' => 'h5p-editor',
            'editorTempfiles' => 'editor-temp',
            'temp' => 'temp',
            'exports' => 'exports',
            'cachedAssets' => 'cached-assets',
        ],
        'libraryPath' => '/vendor/h5p/',
        'aggregateAssets' => '1',
        'enableExport' => '1',
    ];

    public function __construct(private readonly ConfigurationManagerInterface $configurationManager)
    {
        $this->ts = $this->configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            'Lms3h5p',
            'Pi1'
        );

        // Fallback to defaults when TypoScript is not available (CLI context)
        if (empty($this->ts)) {
            $this->ts = self::DEFAULT_SETTINGS;
        }
    }

    /**
     * Copy H5P libraries resources
     */
    public function copyResourcesFromH5PLibraries(): void
    {
        $h5pLibraryPath = dirname(Environment::getPublicPath()) . $this->ts['libraryPath'];

        if (!is_dir($h5pLibraryPath)) {
            throw new \RuntimeException(
                'H5P library source path does not exist: ' . $h5pLibraryPath,
                1650000001
            );
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
