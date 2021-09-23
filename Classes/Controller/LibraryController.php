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

use LMS3\Lms3h5p\Service\H5PIntegrationService;
use LMS3\Lms3h5p\Service\LibraryService;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Http\ForwardResponse;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

/**
 * Library Controller
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class LibraryController extends AbstractModuleController
{
    protected LibraryService $libraryService;
    protected H5PIntegrationService $h5pIntegrationService;

    /**
     * @var BackendTemplateView
     */
    protected $defaultViewObjectName = BackendTemplateView::class;

    public function __construct(LibraryService $libraryService, H5PIntegrationService $h5pIntegrationService)
    {
        $this->libraryService = $libraryService;
        $this->h5pIntegrationService = $h5pIntegrationService;
    }

    /**
     * Index action
     */
    public function indexAction(): ResponseInterface
    {
        $libraries = $this->libraryService->findAll();

        $this->view->assign('libraries', $libraries);

        return $this->htmlResponse();
    }

    /**
     * Show details of library
     */
    public function showAction(int $library): ResponseInterface
    {
        $library = $this->libraryService->findByUid($library);

        $this->view->assign('library', $library);
        $this->view->assign('timeFormat', $GLOBALS['TYPO3_CONF_VARS']['SYS']['hhmm']);
        $this->view->assign('dateFormat', $GLOBALS['TYPO3_CONF_VARS']['SYS']['ddmmyy']);

        return $this->htmlResponse();
    }

    /**
     * Delete library
     */
    public function deleteAction(int $library): ResponseInterface
    {
        $library = $this->libraryService->findByUid($library);

        $this->h5pIntegrationService->getH5PCoreInstance()->deleteLibrary($library->toStdClass());

        $this->addFlashMessage(
            sprintf(
                $this->translate('libraryDeletedMessage'),
                $library->getTitle()
            ),
            $this->translate('libraryDeleted')
        );

        return new ForwardResponse('index');
    }

    /**
     * Refresh content type cache
     */
    public function refreshContentTypeCacheAction(): ResponseInterface
    {
        $h5pCoreInstance = $this->h5pIntegrationService->getH5PCoreInstance();
        if (false === $h5pCoreInstance->updateContentTypeCache()) {
            $this->addFlashMessage(
                $this->translate('h5pHubNotRespondedErrorMessage'),
                '',
                AbstractMessage::ERROR
            );
        }
        $this->addFlashMessage($this->translate('contentTypeCachedRefreshedMessage'));

        return new ForwardResponse('index');
    }

    /**
     * Registers the Icons into the docheader
     *
     * @throws \InvalidArgumentException
     */
    protected function registerDocheaderButtons(): void
    {
        $buttonBar = $this->view->getModuleTemplate()->getDocHeaderComponent()->getButtonBar();

        $uriBuilder = $this->controllerContext->getUriBuilder();

        if ('indexAction' !== $this->actionMethodName) {
            $uri = $uriBuilder->reset()->uriFor('index');
            $title = $this->translate('back');
            $icon = $this->view->getModuleTemplate()
                ->getIconFactory()
                ->getIcon('actions-view-go-back', Icon::SIZE_SMALL);
        } else {
            $uri = $uriBuilder->reset()->uriFor('new', [], 'Content');
            $title = $this->translate('createNewContent');
            $icon = $this->view->getModuleTemplate()
                ->getIconFactory()
                ->getIcon('actions-document-new', Icon::SIZE_SMALL);
        }

        $button = $buttonBar->makeLinkButton()
            ->setHref($uri)
            ->setTitle($title)
            ->setIcon($icon);
        $buttonBar->addButton($button, ButtonBar::BUTTON_POSITION_LEFT);
    }

    /**
     * Initializes the view before invoking an action method.
     */
    protected function initializeView(ViewInterface $view): void
    {
        parent::initializeView($view);

        $actionsExcludeMenu = ['refreshContentTypeCacheAction', 'deleteAction'];

        if (!in_array($this->actionMethodName, $actionsExcludeMenu)) {
            $this->generateMenu();
            $this->registerDocheaderButtons();
        }
    }
}
