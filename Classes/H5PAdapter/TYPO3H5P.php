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

use H5PContentValidator;
use H5PCore;
use H5peditor;
use H5PExport;
use H5PStorage;
use H5PValidator;
use LMS3\Lms3h5p\H5PAdapter\Core\FileAdapter;
use LMS3\Lms3h5p\H5PAdapter\Core\H5PFramework;
use LMS3\Lms3h5p\H5PAdapter\Editor\EditorAjax;
use LMS3\Lms3h5p\H5PAdapter\Editor\EditorFileAdapter;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Site\Entity\SiteLanguage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

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
    protected static ?TYPO3H5P $instance = null;
    protected static ?H5PFramework $interface = null;
    protected static ?H5PCore $core = null;
    protected static array $settings = [];

    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getH5PInstance(string $type = 'interface'): H5PContentValidator|H5PValidator|H5PExport|H5peditor|H5PCore|H5PFramework|H5PStorage|null
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

        return match ($type) {
            'validator' => new \H5PValidator(self::$interface, self::$core),
            'editor' => new \H5peditor(self::$core, new EditorFileAdapter(), new EditorAjax()),
            'storage' => new \H5PStorage(self::$interface, self::$core),
            'contentvalidator' => new \H5PContentValidator(self::$interface, self::$core),
            'export' => new \H5PExport(self::$interface, self::$core),
            'interface' => self::$interface,
            'core' => self::$core,
        };
    }

    public function getSettings(): array
    {
        $configurationManager = GeneralUtility::makeInstance(ConfigurationManagerInterface::class);
        return $configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'Lms3h5p', 'Pi1'
        );
    }

    protected function getLanguage(): string
    {
        if (Environment::isCli()) {
            return "en";
        }

        /** @var SiteLanguage $siteLanguage */
        $siteLanguage = $this->getRequest()->getAttribute('language');
        $language = $siteLanguage?->getLocale()->getLanguageCode();
        
        if (empty($language) || $language === 'default') {
            $language = 'en';
        }

        return $language;
    }

    /**
     * @return ServerRequestInterface
     */
    private function getRequest(): ServerRequestInterface
    {
        return $GLOBALS['TYPO3_REQUEST'];
    }
}
