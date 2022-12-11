<?php
declare(strict_types = 1);

namespace LMS3\Lms3h5p\Domain\Model;

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

use LMS3\Lms3h5p\Domain\Repository\ContentDependencyRepository;
use LMS3\Lms3h5p\Domain\Repository\ContentRepository;
use LMS3\Lms3h5p\Domain\Repository\LibraryDependencyRepository;
use LMS3\Lms3h5p\Traits\ObjectManageable;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Library
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class Library extends AbstractEntity
{
    use ObjectManageable;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var int
     */
    protected $majorVersion;

    /**
     * @var int
     */
    protected $minorVersion;

    /**
     * @var int
     */
    protected $patchVersion;

    /**
     * @var bool
     */
    protected $runnable;

    /**
     * @var bool
     */
    protected $restricted;

    /**
     * @var bool
     */
    protected $fullscreen;

    /**
     * @var string
     */
    protected $embedTypes;

    /**
     * @var string
     */
    protected $preloadedJs;

    /**
     * @var string
     */
    protected $preloadedCss;

    /**
     * @var string
     */
    protected $dropLibraryCss;

    /**
     * @var string
     */
    protected $semantics;

    /**
     * @var string
     */
    protected $tutorialUrl;

    /**
     * @var bool
     */
    protected $hasIcon;

    /**
     * @var string
     */
    protected $metaDataSettings;

    /**
     * @var string
     */
    protected $addTo;

    /**
     * @var int
     */
    protected $createdAt;

    /**
     * @var int
     */
    protected $updatedAt;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Library
     */
    public function setName(string $name): Library
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Library
     */
    public function setTitle(string $title): Library
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int
     */
    public function getMajorVersion(): int
    {
        return $this->majorVersion;
    }

    /**
     * @param int $majorVersion
     * @return Library
     */
    public function setMajorVersion(int $majorVersion): Library
    {
        $this->majorVersion = $majorVersion;
        return $this;
    }

    /**
     * @return int
     */
    public function getMinorVersion(): int
    {
        return $this->minorVersion;
    }

    /**
     * @param int $minorVersion
     * @return Library
     */
    public function setMinorVersion(int $minorVersion): Library
    {
        $this->minorVersion = $minorVersion;
        return $this;
    }

    /**
     * @return int
     */
    public function getPatchVersion(): int
    {
        return $this->patchVersion;
    }

    /**
     * @param int $patchVersion
     * @return Library
     */
    public function setPatchVersion(int $patchVersion): Library
    {
        $this->patchVersion = $patchVersion;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRunnable(): bool
    {
        return $this->runnable;
    }

    /**
     * @param bool $runnable
     * @return Library
     */
    public function setRunnable(bool $runnable): Library
    {
        $this->runnable = $runnable;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRestricted(): bool
    {
        return $this->restricted;
    }

    /**
     * @param bool $restricted
     * @return Library
     */
    public function setRestricted(bool $restricted): Library
    {
        $this->restricted = $restricted;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFullscreen(): bool
    {
        return $this->fullscreen;
    }

    /**
     * @param bool $fullscreen
     * @return Library
     */
    public function setFullscreen(bool $fullscreen): Library
    {
        $this->fullscreen = $fullscreen;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmbedTypes(): string
    {
        return $this->embedTypes;
    }

    /**
     * @param string $embedTypes
     * @return Library
     */
    public function setEmbedTypes(string $embedTypes): Library
    {
        $this->embedTypes = $embedTypes;
        return $this;
    }

    /**
     * @return string
     */
    public function getPreloadedJs(): string
    {
        return $this->preloadedJs;
    }

    /**
     * @param string $preloadedJs
     * @return Library
     */
    public function setPreloadedJs(string $preloadedJs): Library
    {
        $this->preloadedJs = $preloadedJs;
        return $this;
    }

    /**
     * @return string
     */
    public function getPreloadedCss(): string
    {
        return $this->preloadedCss;
    }

    /**
     * @param string $preloadedCss
     * @return Library
     */
    public function setPreloadedCss(string $preloadedCss): Library
    {
        $this->preloadedCss = $preloadedCss;
        return $this;
    }

    /**
     * @return string
     */
    public function getDropLibraryCss(): string
    {
        return $this->dropLibraryCss;
    }

    /**
     * @param string $dropLibraryCss
     * @return Library
     */
    public function setDropLibraryCss(string $dropLibraryCss): Library
    {
        $this->dropLibraryCss = $dropLibraryCss;
        return $this;
    }

    /**
     * @return string
     */
    public function getSemantics(): string
    {
        return $this->semantics;
    }

    /**
     * @param string $semantics
     * @return Library
     */
    public function setSemantics(string $semantics): Library
    {
        $this->semantics = $semantics;
        return $this;
    }

    /**
     * @return string
     */
    public function getTutorialUrl(): string
    {
        return $this->tutorialUrl;
    }

    /**
     * @param string $tutorialUrl
     * @return Library
     */
    public function setTutorialUrl(string $tutorialUrl): Library
    {
        $this->tutorialUrl = $tutorialUrl;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHasIcon(): bool
    {
        return $this->hasIcon;
    }

    /**
     * @param bool $hasIcon
     * @return Library
     */
    public function setHasIcon(bool $hasIcon): Library
    {
        $this->hasIcon = $hasIcon;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getMetaDataSettings(): ?string
    {
        return $this->metaDataSettings;
    }

    /**
     * @param null|string $metaDataSettings
     * @return Library
     */
    public function setMetaDataSettings(?string $metaDataSettings): Library
    {
        $this->metaDataSettings = $metaDataSettings;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAddTo(): ?string
    {
        return $this->addTo;
    }

    /**
     * @param null|string $addTo
     * @return Library
     */
    public function setAddTo(?string $addTo): Library
    {
        $this->addTo = $addTo;
        return $this;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    /**
     * @param int $createdAt
     * @return Library
     */
    public function setCreatedAt(int $createdAt): Library
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getUpdatedAt(): int
    {
        return $this->updatedAt;
    }

    /**
     * @param int $updatedAt
     * @return Library
     */
    public function setUpdatedAt(int $updatedAt): Library
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Creates a library from a metadata array.
     *
     * @param array $libraryData
     * @return Library
     */
    public static function createFromMetadata(array &$libraryData): Library
    {
        $libraryData['__preloadedJs'] = self::pathsToCsv($libraryData, 'preloadedJs');
        $libraryData['__preloadedCss'] = self::pathsToCsv($libraryData, 'preloadedCss');

        $libraryData['__dropLibraryCss'] = '0';
        if (isset($libraryData['dropLibraryCss'])) {
            $libs = array();
            foreach ($libraryData['dropLibraryCss'] as $lib) {
                $libs[] = $lib['machineName'];
            }
            $libraryData['__dropLibraryCss'] = implode(', ', $libs);
        }

        $libraryData['__embedTypes'] = '';
        if (isset($libraryData['embedTypes'])) {
            $libraryData['__embedTypes'] = implode(', ', $libraryData['embedTypes']);
        }
        if (!isset($libraryData['semantics'])) {
            $libraryData['semantics'] = '';
        }
        if (!isset($libraryData['hasIcon'])) {
            $libraryData['hasIcon'] = 0;
        }
        if (!isset($libraryData['fullscreen'])) {
            $libraryData['fullscreen'] = 0;
        }if (!isset($libraryData['fullscreen'])) {
            $libraryData['fullscreen'] = 0;
        }

        $library = new self();
        $library->updateFromMetadata($libraryData);
        $library->setCreatedAt(time())
            ->setUpdatedAt(time())
            ->setRestricted(false)
            ->setTutorialUrl('');

        return $library;
    }

    /**
     * Update library object
     *
     * @param array $libraryData
     * @return void
     */
    public function updateFromMetadata(array $libraryData): void
    {
        $this->setUpdatedAt(time())
            ->setName($libraryData['machineName'])
            ->setTitle($libraryData['title'])
            ->setMajorVersion($libraryData['majorVersion'])
            ->setMinorVersion($libraryData['minorVersion'])
            ->setPatchVersion($libraryData['patchVersion'])
            ->setRunnable((bool) $libraryData['runnable'])
            ->setHasIcon($libraryData['hasIcon'] ? true : false)
            ->setMetaDataSettings($libraryData['metadataSettings'] ?? null)
            ->setAddTo(isset($library['addTo']) ? json_encode($libraryData['addTo']) : null);
        if (isset($libraryData['semantics'])) {
            $this->setSemantics($libraryData['semantics']);
        }
        if (isset($libraryData['fullscreen'])) {
            $this->setFullscreen((bool) $libraryData['fullscreen']);
        }
        if (isset($libraryData['__embedTypes'])) {
            $this->setEmbedTypes($libraryData['__embedTypes']);
            /** @var Content $content */
            foreach ($this->getContents() as $content) {
                /** Embed types might have changed, so we trigger a redetermination */
                $content->determineEmbedType();
            }
        }
        if (isset($libraryData['__preloadedJs'])) {
            $this->setPreloadedJs($libraryData['__preloadedJs']);
        }
        if (isset($libraryData['__preloadedCss'])) {
            $this->setPreloadedCss($libraryData['__preloadedCss']);
        }
        if (isset($libraryData['__dropLibraryCss'])) {
            $this->setDropLibraryCss($libraryData['__dropLibraryCss']);
        }
    }

    /**
     * Returns this library as a stdClass object in a format that H5P expects
     * when it calls the method:
     * @see \H5peditorStorage::getLibraries()
     * @return \stdClass
     */
    public function toStdClass(): \stdClass
    {
        return (object)$this->toAssocArray();
    }

    /**
     * Returns an associative array containing the library in the form that
     * H5PFramework->loadLibrary is expected to return.
     * @see H5PFramework::loadLibrary()
     */
    public function toAssocArray(): array
    {
        // the keys majorVersion and major_version are both used within the h5p library classes. Same goes for minor and patch.
        $libraryArray = [
            'id' => $this->getUid(),
            'libraryId' => $this->getUid(),
            'name' => $this->getName(),
            'machineName' => $this->getName(),
            'title' => $this->getTitle(),
            'major_version' => $this->getMajorVersion(),
            'majorVersion' => $this->getMajorVersion(),
            'minor_version' => $this->getMinorVersion(),
            'minorVersion' => $this->getMinorVersion(),
            'patch_version' => $this->getPatchVersion(),
            'patchVersion' => $this->getPatchVersion(),
            'embedTypes' => $this->getEmbedTypes(),
            'preloadedJs' => $this->getPreloadedJs(),
            'preloadedCss' => $this->getPreloadedCss(),
            'dropLibraryCss' => $this->getDropLibraryCss(),
            'fullscreen' => $this->isFullscreen(),
            'runnable' => $this->isRunnable(),
            'semantics' => $this->getSemantics(),
            'hasIcon' => $this->isHasIcon(),
            'metadataSettings' => $this->getMetaDataSettings()
        ];

//        $dependencies = $this->getLibraryDependencies();
//        /** @var LibraryDependency $dependency */
//        foreach ($dependencies as $dependency) {
//            $libraryArray[$dependency->getDependencyType() . 'Dependencies'][] = [
//                'machineName' => $dependency->getRequiredLibrary()->getName(),
//                'majorVersion' => $dependency->getRequiredLibrary()->getMajorVersion(),
//                'minorVersion' => $dependency->getRequiredLibrary()->getMinorVersion()
//            ];
//        }

        return $libraryArray;
    }

    /**
     * @return mixed
     */
    public function getContents()
    {
        /** @var ContentRepository $contentRepository */
        $contentRepository = $this->createObject(ContentRepository::class);
        $contentRepository->setDefaultQuerySettings(
            $contentRepository->createQuery()->getQuerySettings()->setRespectStoragePage(false)
        );

        return $contentRepository->findByLibrary($this->getUid());
    }

    /**
     * @return mixed
     */
    public function getLibraryDependencies()
    {
        $dependencyRepository = $this->createObject(LibraryDependencyRepository::class);
        $dependencyRepository->setDefaultQuerySettings(
            $dependencyRepository->createQuery()->getQuerySettings()->setRespectStoragePage(false)
        );

        return $dependencyRepository->findByLibrary($this->getUid());
    }

    /**
     * @return mixed
     */
    public function getDependentLibraries()
    {
        $dependencyRepository = $this->createObject(LibraryDependencyRepository::class);
        $dependencyRepository->setDefaultQuerySettings(
            $dependencyRepository->createQuery()->getQuerySettings()->setRespectStoragePage(false)
        );

        return $dependencyRepository->findByRequiredLibrary($this->getUid());
    }

    /**
     * @return mixed
     */
    public function getContentDependencies()
    {
        $contentDependencyRepository = $this->createObject(ContentDependencyRepository::class);
        $contentDependencyRepository->setDefaultQuerySettings(
            $contentDependencyRepository->createQuery()->getQuerySettings()->setRespectStoragePage(false)
        );

        return $contentDependencyRepository->findByLibrary($this->getUid());
    }

    /**
     * @return string
     */
    public function getVersionString() : string
    {
        return $this->getMajorVersion() . '.' . $this->getMinorVersion() . '.' . $this->getPatchVersion();
    }

    /**
     * Convert list of file paths to csv
     *
     * @param array $library Library data as found in library.json files
     * @param string $key Key that should be found in $libraryData
     * @return string File paths separated by ', '
     */
    private static function pathsToCsv($library, $key): string
    {
        if (isset($library[$key])) {
            $paths = array();
            foreach ($library[$key] as $file) {
                $paths[] = $file['path'];
            }
            return implode(', ', $paths);
        }
        return '';
    }

}