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
use LMS3\Lms3h5p\H5PAdapter\Core\H5PFramework;
use LMS3\Lms3h5p\H5PAdapter\TYPO3H5P;
use LMS3\Lms3h5p\Traits\ObjectManageable;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Mvc\Controller\ControllerContext;

/**
 * H5P Integration service
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class H5PIntegrationService implements SingletonInterface
{
    use ObjectManageable;

    /**
     * @var H5PFramework
     */
    protected $h5pFramework;

    /**
     * @var array
     */
    protected $h5pSettings;

    /**
     * @var ContentService
     */
    protected $contentService;

    /**
     * Inject ContentService
     *
     * @param ContentService $contentService
     */
    public function injectContentService(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    /**
     * H5PIntegrationService constructor.
     */
    public function __construct()
    {
        $configurationManager = $this->createObject(ConfigurationManager::class);
        $this->h5pSettings = $configurationManager->getConfiguration(
            ConfigurationManager::CONFIGURATION_TYPE_SETTINGS,
            'Lms3h5p',
            'Pi1'
        );
    }

    /**
     * Inject H5PFramework
     *
     * @param H5PFramework $h5PFramework
     */
    public function injectH5PFramework(H5PFramework $h5PFramework)
    {
        $this->h5pFramework = $h5PFramework;
    }

    /**
     * Returns an array with a set of core settings that the H5P JavaScript needs
     * to do its thing. Can also include editor settings.
     *
     * @param ControllerContext $controllerContext
     * @param array<int> $displayContentIds content IDs for which display settings should be generated
     * @return array
     */
    public function getH5PSettings(ControllerContext $controllerContext, array $displayContentIds = []): array
    {
        $coreSettings = $this->generateCoreSettings($controllerContext);
        foreach ($displayContentIds as $contentId) {
            $coreSettings['contents']['cid-' . $contentId] = $this->generateContentSettings(
                $controllerContext,
                (int) $contentId
            );
        }

        return $coreSettings;
    }

    /**
     * Get the settings with editor
     *
     * @param ControllerContext $controllerContext
     * @param int $editorContentId content ID for which editor settings should be generated
     * @return array
     */
    public function getSettingsWithEditor(ControllerContext $controllerContext, int $editorContentId = -1): array
    {
        $coreSettings = $this->generateCoreSettings($controllerContext);
        $coreSettings['editor'] = $this->generateEditorSettings($controllerContext, $editorContentId);

        return $coreSettings;
    }

    /**
     * Returns an array with a set of editor settings that the H5P JavaScript needs
     * to do its thing.
     *
     * @param ControllerContext $controllerContext
     * @param int $contentId provide this to set the "nodeVersionId" - needed to edit contents.
     * @return array
     */
    private function generateEditorSettings(ControllerContext $controllerContext, int $contentId = -1): array
    {
        $editorAjaxAction = $controllerContext->getUriBuilder()->reset()->uriFor(
            'index', [], 'EditorAjax'
        );

        $editorSettings = [
            'filesPath' => $this->h5pSettings['h5pPublicFolder']['url'] . $this->h5pSettings['subFolders']['editorTempfiles'],
            'fileIcon' => [
                'path' => $this->h5pSettings['h5pPublicFolder']['url'] . $this->h5pSettings['subFolders']['editor'] . '/images/binary-file.png',
                'width' => 50,
                'height' => 50,
            ],
            'ajaxPath' => $editorAjaxAction . '&type=',
            'libraryUrl' => $this->h5pSettings['h5pPublicFolder']['url'] . $this->h5pSettings['subFolders']['editor'] . '/',
            'copyrightSemantics' => $this->getH5pContentValidator()->getCopyrightSemantics(),
            'metadataSemantics' => $this->getH5pContentValidator()->getMetadataSemantics(),
            'assets' => [
                'css' => array_merge($this->getRelativeCoreStyleUrls(), $this->getRelativeEditorStyleUrls()),
                'js' => array_merge($this->getRelativeCoreScriptUrls(), $this->getRelativeEditorScriptUrls())
            ],
            'apiVersion' => \H5PCore::$coreApi
        ];

        if ($contentId !== -1) {
            $editorSettings['nodeVersionId'] = $contentId;
        }

        return $editorSettings;
    }

    /**
     * Returns an array with a set of core settings that the H5P JavaScript needs
     * to do its thing.
     *
     * @param ControllerContext $controllerContext
     * @return array
     */
    public function generateCoreSettings(ControllerContext $controllerContext): array
    {
        $settings = [
            'baseUrl' => GeneralUtility::getIndpEnv('TYPO3_SITE_URL'),
            'url' => $this->h5pSettings['h5pPublicFolder']['url'],
            'postUserStatistics' => true,
            'ajax' => [
                'setFinished' => '',
                'contentUserData' => ''
            ],
            'saveFreq' => (integer) $this->h5pFramework->getOption('save_content_frequency') ?? false,
            'siteUrl' => GeneralUtility::getIndpEnv('TYPO3_SITE_URL'),
            'l10n' => [
                'H5P' => $this->getLocalization(),
            ],
            'hubIsEnabled' => (bool) $this->h5pFramework->getOption('hub_is_enabled') == 1,
            'reportingIsEnabled' => (bool) $this->h5pFramework->getOption('enable_lrs_content_types') == 1,
            'core' => [
                'scripts' => $this->getRelativeCoreScriptUrls(),
                'styles' => $this->getRelativeCoreStyleUrls()
            ]
        ];

        return $settings;
    }

    /**
     * Generates the relative script urls the H5P JS expects in window.H5PIntegration.scripts.
     * Is needed for the window.H5PIntegration object and also to actually load these scripts into
     * the window as head scripts.
     *
     * @return array
     */
    private function getRelativeCoreScriptUrls(): array
    {
        $urls = [];
        foreach (\H5PCore::$scripts as $script) {
            $urls[] = $this->h5pSettings['h5pPublicFolder']['url'] . $this->h5pSettings['subFolders']['core'] . DIRECTORY_SEPARATOR . $script;
        }

        return $urls;
    }

    /**
     * Generates the relative style urls the H5P JS expects in window.H5PIntegration.styles.
     * Is needed for the window.H5PIntegration object and also to actually load these styles into
     * the window as head styles.
     *
     * @return array
     */
    private function getRelativeCoreStyleUrls(): array
    {
        $urls = [];
        foreach (\H5PCore::$styles as $style) {
            $urls[] = $this->h5pSettings['h5pPublicFolder']['url'] . $this->h5pSettings['subFolders']['core'] . DIRECTORY_SEPARATOR . $style;
        }

        return $urls;
    }

    /**
     * Generates the relative script urls the H5P JS expects in window.H5PIntegration.editor.assets.js.
     * Is needed for the window.H5PIntegration object and also to actually load these scripts into
     * the window as head scripts.
     *
     * @return array
     */
    private function getRelativeEditorScriptUrls(): array
    {
        $urls = [];
        foreach (\H5peditor::$scripts as $script) {
            /**
             * We do not want the creator of the iframe inside the iframe.
             * If we loaded this, the iframe would continually try to load more iframes inside itself.
             * This is a bug in the H5P integration (or rather a weird way of declaring the libraries)
             */
            if (strpos($script, 'scripts/h5peditor-editor.js') !== false) {
                continue;
            }
            $urls[] = $this->h5pSettings['h5pPublicFolder']['url'] . $this->h5pSettings['subFolders']['editor'] . DIRECTORY_SEPARATOR . $script;
        }

        $language = $GLOBALS['BE_USER']->uc['lang'] ?: 'en';
        $urls[] = $this->h5pSettings['h5pPublicFolder']['url'] . $this->h5pSettings['subFolders']['editor'] . "/language/{$language}.js";

        return $urls;
    }

    /**
     * Generates the relative style urls the H5P JS expects in window.H5PIntegration.editor.assets.css.
     * Is needed for the window.H5PIntegration object and also to actually load these styles into
     * the window as head styles.
     *
     * @return array
     */
    private function getRelativeEditorStyleUrls(): array
    {
        $urls = [];
        foreach (\H5peditor::$styles as $style) {
            $urls[] = $this->h5pSettings['h5pPublicFolder']['url'] . $this->h5pSettings['subFolders']['editor'] . DIRECTORY_SEPARATOR . $style;
        }
        return $urls;
    }

    /**
     * Get settings for given content
     *
     * @param ControllerContext $controllerContext
     * @param int $contentId
     * @return array
     */
    private function generateContentSettings(ControllerContext $controllerContext, int $contentId)
    {
        /** @var Content $content */
        $content = $this->contentService->findByUid($contentId);
        if ($content === null) {
            return [];
        }

        $contentArray = $content->toAssocArray();

        $embedUrl =  $controllerContext->getUriBuilder() ? $controllerContext->getUriBuilder()->reset()->uriFor(
            'index', ['content' => $content], 'ContentEmbed'
        ) : '';

        $h5pCorePublicUrl = $this->h5pSettings['h5pPublicFolder']['url'] . $this->h5pSettings['subFolders']['core'];

        // Add JavaScript settings for this content
        $contentSettings = [
            'library' => \H5PCore::libraryToString($contentArray['library']),
            'jsonContent' => $content->getFiltered(),
            'fullScreen' => $contentArray['library']['fullscreen'],
            'exportUrl' => $content->getExportFile() ? GeneralUtility::getIndpEnv('TYPO3_SITE_URL') . ltrim($this->h5pSettings['h5pPublicFolder']['url'], '/') . $this->h5pSettings['subFolders']['exports'] . DIRECTORY_SEPARATOR . $content->getExportFile() : '',
            'embedCode' => '<iframe src="' . $embedUrl . '" width=":w" height=":h" frameborder="0" allowfullscreen="allowfullscreen"></iframe>',
            'resizeCode' => '<script src="' . $h5pCorePublicUrl . '/js/h5p-resizer.js' . '" charset="UTF-8"></script>',
            'url' => $embedUrl,
            'title' => $contentArray['title'],
            // TODO: use actual account identifier instead of 0 - this is needed only for an auth check, which we default to true currently.
            'displayOptions' => $this->getH5PCoreInstance()->getDisplayOptionsForView($contentArray['disable'], 0),
            'metadata' => $contentArray['metadata'],
        ];

        // Get assets for this content
        $preloadedDependencies = $this->getH5PCoreInstance()->loadContentDependencies(
            $content->getUid(),
            'preloaded'
        );
        $files = $this->getH5PCoreInstance()->getDependenciesFiles(
            $preloadedDependencies,
            $this->h5pSettings['h5pPublicFolder']['url']
        );

        $this->addCustomStylesheet($files['styles']);

        $buildUrl = function (\stdClass $asset) {
            return $asset->path . $asset->version;
        };
        $contentSettings['scripts'] = array_map($buildUrl, $files['scripts']);
        $contentSettings['styles'] = array_map($buildUrl, $files['styles']);

        return $contentSettings;
    }

    /**
     * Merges the core scripts with all content scripts, so that there is one list of scripts that
     * can be passed to a template for inclusion.
     *
     * @param array $h5pIntegrationSettings
     * @return array
     */
    public function getMergedScripts(array $h5pIntegrationSettings): array
    {
        $scripts = $h5pIntegrationSettings['core']['scripts'];
        foreach ($h5pIntegrationSettings['contents'] as $contentSettings) {
            if (isset($contentSettings['scripts'])) {
                foreach ($contentSettings['scripts'] as $script) {
                    $scripts[] = $script;
                }
            }
        }

        return $scripts;
    }

    /**
     * Merges the core styles with all content styles, so that there is one list of styles that
     * can be passed to a template for inclusion.
     *
     * @param array $h5pIntegrationSettings
     * @return array
     */
    public function getMergedStyles(array $h5pIntegrationSettings): array
    {
        $styles = $h5pIntegrationSettings['core']['styles'];
        foreach ($h5pIntegrationSettings['contents'] as $contentSettings) {
            if (isset($contentSettings['styles'])) {
                foreach ($contentSettings['styles'] as $style) {
                    if (false === strpos($style, 'version')) {
                        $styles[] = $style . '?version=' . $this->h5pSettings['customStyle']['version'];
                    }
                }
            }
        }

        return $styles;
    }

    /**
     * Provide localization for the Core JS
     *
     * @return array
     */
    public function getLocalization(): array
    {
        return [
            'fullscreen' => $this->translate('fullscreen'),
            'disableFullscreen' => $this->translate('disableFullscreen'),
            'download' => $this->translate('download'),
            'copyrights' => $this->translate('copyrights'),
            'embed' => $this->translate('embed'),
            'size' => $this->translate('size'),
            'showAdvanced' => $this->translate('showAdvanced'),
            'hideAdvanced' => $this->translate('hideAdvanced'),
            'advancedHelp' => $this->translate('advancedHelp'),
            'copyrightInformation' => $this->translate('copyrightInformation'),
            'close' => $this->translate('close'),
            'title' => $this->translate('title'),
            'author' => $this->translate('author'),
            'year' => $this->translate('year'),
            'source' => $this->translate('source'),
            'license' => $this->translate('license'),
            'thumbnail' => $this->translate('thumbnail'),
            'noCopyrights' => $this->translate('noCopyrights'),
            'reuse' => $this->translate('reuse'),
            'reuseContent' => $this->translate('reuseContent'),
            'reuseDescription' => $this->translate('reuseDescription'),
            'downloadDescription' => $this->translate('downloadDescription'),
            'copyrightsDescription' => $this->translate('copyrightsDescription'),
            'embedDescription' => $this->translate('embedDescription'),
            'h5pDescription' => $this->translate('h5pDescription'),
            'contentChanged' => $this->translate('contentChanged'),
            'startingOver' => $this->translate('startingOver'),
            'by' => $this->translate('by'),
            'showMore' => $this->translate('showMore'),
            'showLess' => $this->translate('showLess'),
            'subLevel' => $this->translate('subLevel'),
            'confirmDialogHeader' => $this->translate('confirmDialogHeader'),
            'confirmDialogBody' => $this->translate('confirmDialogBody'),
            'cancelLabel' => $this->translate('cancelLabel'),
            'confirmLabel' => $this->translate('confirmLabel'),
            'licenseU' => $this->translate('licenseU'),
            'licenseCCBY' => $this->translate('licenseCCBY'),
            'licenseCCBYSA' => $this->translate('licenseCCBYSA'),
            'licenseCCBYND' => $this->translate('licenseCCBYND'),
            'licenseCCBYNC' => $this->translate('licenseCCBYNC'),
            'licenseCCBYNCSA' => $this->translate('licenseCCBYNCSA'),
            'licenseCCBYNCND' => $this->translate('licenseCCBYNCND'),
            'licenseCC40' => $this->translate('licenseCC40'),
            'licenseCC30' => $this->translate('licenseCC30'),
            'licenseCC25' => $this->translate('licenseCC25'),
            'licenseCC20' => $this->translate('licenseCC20'),
            'licenseCC10' => $this->translate('licenseCC10'),
            'licenseGPL' => $this->translate('licenseGPL'),
            'licenseV3' => $this->translate('licenseV3'),
            'licenseV2' => $this->translate('licenseV2'),
            'licenseV1' => $this->translate('licenseV1'),
            'licensePD' => $this->translate('licensePD'),
            'licenseCC010' => $this->translate('licenseCC010'),
            'licensePDM' => $this->translate('licensePDM'),
            'licenseC' => $this->translate('licenseC'),
            'contentType' => $this->translate('contentType'),
            'licenseExtras' => $this->translate('licenseExtras'),
            'changes' => $this->translate('changes'),
            'contentCopied' => $this->translate('contentCopied'),
        ];
    }

    /**
     * Translate by id
     *
     * @return string
     */
    protected function translate($key): string
    {
        $lang = $GLOBALS['TSFE'] ?? $GLOBALS['LANG'];

        return $lang->sL('LLL:EXT:lms3h5p/Resources/Private/Language/locallang_h5p.xlf:' . $key);
    }

    /**
     * Add custom stylesheet
     *
     * @param array $styles
     * @return void
     */
    protected function addCustomStylesheet(array &$styles): void
    {
        $customStyle = GeneralUtility::getFileAbsFileName($this->h5pSettings['customStyle']['path']);
        if (file_exists($customStyle)) {
            $styles[] = (object) [
                'path'    => '/' . $this->h5pSettings['customStyle']['path'],
                'version' => '?version=' . $this->h5pSettings['customStyle']['version']
            ];
        }
    }

    /**
     * Get the H5PCore instance
     *
     * @return \H5PCore
     */
    public function getH5PCoreInstance(): \H5PCore
    {
        /** @var TYPO3H5P $TYPO3H5P */
        $TYPO3H5P = $this->createObject(TYPO3H5P::class);

        return $TYPO3H5P->getH5PInstance('core');
    }

    /**
     * Get the H5P Content Validator
     *
     * @return \H5PContentValidator
     */
    public function getH5pContentValidator(): \H5PContentValidator
    {
        /** @var TYPO3H5P $TYPO3H5P */
        $TYPO3H5P = $this->createObject(TYPO3H5P::class);

        return $TYPO3H5P->getH5PInstance('contentvalidator');
    }

    /**
     * Get the H5P Editor
     *
     * @return \H5peditor
     */
    public function getH5pEditor(): \H5peditor
    {
        /** @var TYPO3H5P $TYPO3H5P */
        $TYPO3H5P = $this->createObject(TYPO3H5P::class);

        return $TYPO3H5P->getH5PInstance('editor');
    }

    /**
     * @return array
     */
    public function getSettings(): array
    {
        return $this->h5pSettings;
    }

}
