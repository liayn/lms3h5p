<?php

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

use \TYPO3\CMS\Extbase\Utility\ExtensionUtility;

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

ExtensionUtility::registerPlugin(
    'Lms3h5p',
    'Pi1',
    'LLL:EXT:lms3h5p/Resources/Private/Language/locallang.xlf:tx_lms3h5p_domain_model_pi1'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
    'Lms3h5p',
    'web',
    'Content',
    'after:page',
    [
        \LMS3\Lms3h5p\Controller\ContentController::class => 'index, create, new, show, edit, update, delete',
        \LMS3\Lms3h5p\Controller\EditorAjaxController::class => 'index',
        \LMS3\Lms3h5p\Controller\LibraryController::class => 'index, show, delete, refreshContentTypeCache'
    ],
    [
        'access' => 'user,group',
        'icon' => 'EXT:lms3h5p/Resources/Public/Icons/lms3h5p.png',
        'labels' => 'LLL:EXT:lms3h5p/Resources/Private/Language/locallang_mod.xlf',
    ]
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'Lms3h5p',
    'Configuration/TypoScript',
    'LMS3 H5P Content'
);
