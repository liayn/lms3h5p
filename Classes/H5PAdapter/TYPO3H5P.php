<?php
declare(strict_types = 1);

namespace LMS3\Lms3h5p\H5PAdapter;

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

use LMS3\Lms3h5p\H5PAdapter\Core\FileAdapter;
use LMS3\Lms3h5p\H5PAdapter\Core\H5PFramework;
use LMS3\Lms3h5p\H5PAdapter\Editor\EditorAjax;
use LMS3\Lms3h5p\H5PAdapter\Editor\EditorFileAdapter;
use LMS3\Lms3h5p\Traits\ObjectManageable;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;

/**
 * EditorAjaxController
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class TYPO3H5P
{
    use ObjectManageable;

    /**
     * Instance of this class
     *
     * @var \LMS3\Lms3h5p\H5PAdapter\TYPO3H5P
     */
    protected static $instance = null;

    /**
     * Instance of H5P TYPO3 Framework Interface.
     *
     * @var \LMS3\Lms3h5p\H5PAdapter\Core\H5PFramework
     */
    protected static $interface = null;

    /**
     * Instance of H5P Core.
     *
     * @var \H5PCore
     */
    protected static $core = null;

    /**
     * H5P Settings
     *
     * @var array
     */
    protected static $settings = [];

    /**
     * Return an instance of this class
     *
     * @return \LMS3\Lms3h5p\H5PAdapter\TYPO3H5P
     */
    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Get H5P Instance
     *
     * @param string $type
     * @return \H5PContentValidator|\H5PCore|\H5PExport|\H5PStorage|\H5PValidator|H5PFramework|\H5peditor
     */
    public function getH5PInstance(string $type)
    {
        $settings = $this->getSettings();
        if (null === self::$interface) {
            self::$interface = new H5PFramework();
            self::$core = new \H5PCore(
                self::$interface,
                new FileAdapter(),
                $settings['h5pPublicFolder']['url'],
                $this->getLanguage(),
                (bool) $settings['enableExport']
            );
            self::$core->aggregateAssets = (bool) $settings['aggregateAssets'];
        }

        switch ($type) {
            case 'validator':
                return new \H5PValidator(self::$interface, self::$core);
            case 'editor':
                return new \H5peditor(self::$core, new EditorFileAdapter(), new EditorAjax());
            case 'storage':
                return new \H5PStorage(self::$interface, self::$core);
            case 'contentvalidator':
                return new \H5PContentValidator(self::$interface, self::$core);
            case 'export':
                return new \H5PExport(self::$interface, self::$core);
            case 'interface':
                return self::$interface;
            case 'core':
                return self::$core;
        }
    }

    /**
     * Get settings
     *
     * @return array
     */
    public function getSettings(): array
    {
        $configurationManager = $this->createObject(ConfigurationManager::class);
        return $configurationManager->getConfiguration(
            ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'Lms3h5p', 'Pi1'
        );
    }

    /**
     * Get language
     *
     * @return string
     */
    protected function getLanguage(): string
    {
        if (!isset($GLOBALS['BE_USER']) || $GLOBALS['BE_USER']->uc['lang'] === null || $GLOBALS['BE_USER']->uc['lang'] === 'default') {
            return 'en';
        }

        return $GLOBALS['BE_USER']->uc['lang'];
    }

}
