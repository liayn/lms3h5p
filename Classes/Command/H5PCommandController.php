<?php
declare(strict_types = 1);

namespace LMS3\Lms3h5p\Command;

/* * *************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
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

use LMS3\Lms3h5p\H5PAdapter\TYPO3H5P;
use LMS3\Lms3h5p\Setup;
use LMS3\Lms3h5p\Traits\ObjectManageable;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

/**
 * H5P Command Controller
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class H5PCommandController extends CommandController
{
    use ObjectManageable;

    /**
     * Setup initial configuration
     */
    public function configSettingCommand(): void
    {
        $configurationManager = $this->createObject(ConfigurationManager::class);
        $h5pSettings = $configurationManager->getConfiguration(ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'Lms3h5p', 'Pi1');
        /** @var TYPO3H5P $TYPO3H5P */
        $TYPO3H5P = $this->createObject(TYPO3H5P::class);

        $interface = $TYPO3H5P->getH5PInstance('interface');

        if (isset($h5pSettings['config'])) {
            foreach ($h5pSettings['config'] as $name => $value) {
                $interface->setOption($name, $value);
            }
            $this->outputLine('Config settings imported successfully.');
        }
    }

    /**
     * Copy H5P core and editor resources
     *
     * @param string Relative path to copy resources e.g. /fileadmin/h5p/
     */
    public function copyResourcesCommand($path = null)
    {
        $h5pSetup = $this->createObject(Setup::class);
        $h5pSetup->copyResourcesFromH5PLibraries('lms3h5p', $path);
        $this->outputLine('Resources copied successfully.');
    }
}