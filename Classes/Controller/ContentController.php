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

use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

/**
 * ContentController
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class ContentController extends AbstractModuleController
{
    /**
     * @var BackendTemplateView
     */
    protected $defaultViewObjectName = BackendTemplateView::class;

    /**
     * @var BackendTemplateView
     */
    protected $view;

    /**
     * @var \LMS3\Lms3h5p\Service\H5PIntegrationService
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $h5pIntegrationService;

    /**
     * @var \LMS3\Lms3h5p\Service\ContentService
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $contentService;

    /**
     * @var int
     */
    protected $pageId;

    /**
     * Initializes the view before invoking an action method.
     *
     * @param ViewInterface $view The view to be initialized
     */
    protected function initializeView(ViewInterface $view): void
    {
        /** @var BackendTemplateView $view */
        parent::initializeView($view);

        $actions = ['createAction', 'updateAction', 'deleteAction'];
        if (!in_array($this->actionMethodName, $actions)) {
            $this->generateMenu();
            $this->registerDocheaderButtons();
        }
    }

    /**
     * Set current selected storage for content creation and display
     *
     * @return void
     */
    protected function setStoragePid(): void
    {
        $storagePid = GeneralUtility::_GP('id');
        $frameworkConfiguration = $this->configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
        );
        $persistenceConfiguration = array('persistence' => array('storagePid' => $storagePid));
        $this->configurationManager->setConfiguration(array_merge($frameworkConfiguration, $persistenceConfiguration));
    }

    /**
     * Index action
     *
     * @return void
     */
    public function indexAction(): void
    {
        $this->setStoragePid();

        $contents = $this->contentService->findAll();
        $this->view->assign('contents', $contents);
        $this->view->assign('dateFormat', $GLOBALS['TYPO3_CONF_VARS']['SYS']['ddmmyy']);
        $this->view->assign('timeFormat', $GLOBALS['TYPO3_CONF_VARS']['SYS']['hhmm']);
        $this->view->assign('pid', empty(GeneralUtility::_GP('id')));
    }

    /**
     * Create new content
     *
     * @return void
     */
    public function newAction(): void
    {
        $parameters = '';
        $h5pIntegrationSettings = $this->h5pIntegrationService->getSettingsWithEditor($this->getControllerContext());

        $this->view->assign('h5pSettings', json_encode($h5pIntegrationSettings));
        $this->view->assign('scripts', $h5pIntegrationSettings['core']['scripts']);
        $this->view->assign('styles', $h5pIntegrationSettings['core']['styles']);
        $this->view->assign('pid', empty(GeneralUtility::_GP('id')));
        $this->view->assign('parameters', $parameters);
    }

    /**
     * Create content
     *
     * @return void
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     */
    public function createAction(): void
    {
        $this->setStoragePid();

        $library = $this->request->getArgument('library');
        $parameters = $this->request->getArgument('parameters');
        $options = $this->request->getArgument('options');

        $content = $this->contentService->handleCreateOrUpdate($library, $parameters, null, $options);
        if ($content === null) {
            $this->showH5pErrorMessages();
            $this->redirect('new');
        } else {
            $this->addFlashMessage(
                sprintf(
                    $this->translate('contentCreatedMessage'),
                    $content->getTitle()
                ),
                $this->translate('contentCreated'),
                AbstractMessage::OK
            );
            $this->redirect('show', null, null, ['content' => $content]);
        }
    }

    /**
     * Show details of content
     *
     * @param int $content
     * @return void
     */
    public function showAction(int $content): void
    {
        $this->setStoragePid();
        $content = $this->contentService->findByUid($content);
        $h5pIntegrationSettings = $this->h5pIntegrationService->getH5PSettings(
            $this->controllerContext,
            [
                $content->getUid()
            ]
        );

        $this->view->assign('content', $content);
        $this->view->assign('h5pSettings', json_encode($h5pIntegrationSettings));
        $this->view->assign('scripts', $this->h5pIntegrationService->getMergedScripts($h5pIntegrationSettings));
        $this->view->assign('styles', $this->h5pIntegrationService->getMergedStyles($h5pIntegrationSettings));
    }

    /**
     * Edit content
     *
     * @param int $content
     * @return void
     */
    public function editAction(int $content): void
    {
        $content = $this->contentService->findByUid($content);
        $h5pIntegrationSettings = $this->h5pIntegrationService->getSettingsWithEditor(
            $this->controllerContext,
            $content->getUid()
        );
        $metadata = (object)['title' => $content->getTitle(), 'license' => $content->getLicense()];
        $parameters = '{"params":' . $content->getFiltered() . ', "metadata":' . json_encode($metadata) . '}';
        $options = $this->h5pIntegrationService->getH5PCoreInstance()->getDisplayOptionsForEdit($content->getDisable());

        $this->view->assign('h5pSettings', json_encode($h5pIntegrationSettings));
        $this->view->assign('scripts', $h5pIntegrationSettings['core']['scripts']);
        $this->view->assign('styles', $h5pIntegrationSettings['core']['styles']);
        $this->view->assign('content', $content);
        $this->view->assign('parameters', $parameters);
        $this->view->assign('options', $options);
    }

    /**
     * Update content
     *
     * @return void
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     */
    public function updateAction(): void
    {
        $library = $this->request->getArgument('library');
        $parameters = $this->request->getArgument('parameters');
        $contentId = $this->request->getArgument('contentId');
        $options = $this->request->getArgument('options');

        $content = $this->contentService->handleCreateOrUpdate($library, $parameters, $contentId, $options);
        if (null === $content) {
            $this->showH5pErrorMessages();
            $this->redirect('index');
        } else {
            $this->addFlashMessage(
                sprintf(
                    $this->translate('contentUpdatedMessage'),
                    $content->getTitle()
                ),
                $this->translate('contentUpdated'),
                AbstractMessage::OK
            );
            $this->redirect('show', null, null, ['content' => $content]);
        }
    }

    /**
     * Delete content
     *
     * @param int $content
     * @return void
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     */
    public function deleteAction($content): void
    {
        $content = $this->contentService->findByUid($content);
        $this->contentService->handleDelete($content);

        $this->addFlashMessage(
            sprintf(
                $this->translate('contentDeletedMessage'),
                $content->getTitle()
            ),
            $this->translate('contentDeleted'),
            AbstractMessage::OK
        );
        $this->redirect('index', null, null);
    }

    /**
     * Registers the Icons into the docheader
     *
     * @return void
     * @throws \InvalidArgumentException
     */
    protected function registerDocheaderButtons(): void
    {
        /** @var ButtonBar $buttonBar */
        $buttonBar = $this->view->getModuleTemplate()->getDocHeaderComponent()->getButtonBar();

        $uriBuilder = $this->controllerContext->getUriBuilder();

        if ('indexAction' !== $this->actionMethodName) {
            $uri = $uriBuilder->reset()->uriFor('index');
            $title = $this->translate('back');
            $icon = $this->view->getModuleTemplate()
                ->getIconFactory()
                ->getIcon('actions-view-go-back', Icon::SIZE_SMALL);
            $button = $buttonBar->makeLinkButton()
                ->setHref($uri)
                ->setTitle($title)
                ->setIcon($icon);
            $buttonBar->addButton($button, ButtonBar::BUTTON_POSITION_LEFT);
        } else {
            $uri = $uriBuilder->reset()->uriFor('new');
            $title = $this->translate('createNewContent');
            $icon = $this->view->getModuleTemplate()
                ->getIconFactory()
                ->getIcon('actions-document-new', Icon::SIZE_SMALL);
            $button = $buttonBar->makeLinkButton()
                ->setHref($uri)
                ->setTitle($title)
                ->setIcon($icon);
            $buttonBar->addButton($button, ButtonBar::BUTTON_POSITION_LEFT);
        }
    }

    /**
     * Show H5P Error messages
     *
     * @return void
     */
    private function showH5pErrorMessages(): void
    {
        foreach ($this->h5pIntegrationService->getH5PCoreInstance()->h5pF->getMessages('error') as $errorMessage) {
            $this->addFlashMessage(
                $errorMessage->message,
                $errorMessage->code ?: $this->translate('h5pError'),
                AbstractMessage::ERROR
            );
        }
    }
}
