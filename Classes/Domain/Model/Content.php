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

/**
 * Content
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class Content extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var \LMS3\Lms3h5p\Domain\Model\Library
     */
    protected $library;

    /**
     * @var \LMS3\Lms3h5p\Domain\Model\BackendUser
     */
    protected $account;

    /**
     * @var int
     */
    protected $createdAt;

    /**
     * @var int
     */
    protected $updatedAt;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $parameters;

    /**
     * @var string
     */
    protected $filtered;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $embedType;

    /**
     * @var int
     */
    protected $disable;

    /**
     * @var string
     */
    protected $contentType;

    /**
     * @var string
     */
    protected $author;

    /**
     * @var string
     */
    protected $license;

    /**
     * @var string
     */
    protected $keywords;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $zippedContentFile;

    /**
     * @var string
     */
    protected $exportFile;

    /**
     * @var string|null
     */
    protected $source;

    /**
     * @var int|null
     */
    protected $yearFrom;

    /**
     * @var int|null
     */
    protected $yearTo;

    /**
     * @var string|null
     */
    protected $licenseVersion;

    /**
     * @var string|null
     */
    protected $licenseExtras;

    /**
     * @var string
     */
    protected $authorComments;

    /**
     * @var string
     */
    protected $changes;

    /**
     * @return Library
     */
    public function getLibrary(): Library
    {
        return $this->library;
    }

    /**
     * @param Library $library
     * @return Content
     */
    public function setLibrary(Library $library): self
    {
        $this->library = $library;
        return $this;
    }

    /**
     * @return \LMS3\Lms3h5p\Domain\Model\BackendUser|null
     */
    public function getAccount(): ?BackendUser
    {
        return $this->account;
    }

    /**
     * @param int $account
     * @return Content
     */
    public function setAccount(int $account): self
    {
        $this->account = $account;
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
     * @return Content
     */
    public function setCreatedAt(int $createdAt): Content
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
     * @return Content
     */
    public function setUpdatedAt(int $updatedAt): Content
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return (string)$this->title;
    }

    /**
     * @param string $title
     * @return Content
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getParameters(): string
    {
        return (string)$this->parameters;
    }

    /**
     * @param string $parameters
     * @return Content
     */
    public function setParameters(string $parameters): self
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * @return string
     */
    public function getFiltered(): string
    {
        return (string)$this->filtered;
    }

    /**
     * @param string $filtered
     * @return Content
     */
    public function setFiltered(string $filtered): self
    {
        $this->filtered = $filtered;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Content
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmbedType(): string
    {
        return (string)$this->embedType;
    }

    /**
     * @param string $embedType
     * @return Content
     */
    public function setEmbedType(string $embedType): self
    {
        $this->embedType = $embedType;
        return $this;
    }

    /**
     * @return int
     */
    public function getDisable(): int
    {
        return $this->disable;
    }

    /**
     * @param int $disable
     * @return Content
     */
    public function setDisable(int $disable): self
    {
        $this->disable = $disable;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return (string)$this->contentType;
    }

    /**
     * @param string $contentType
     * @return Content
     */
    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return (string)$this->author;
    }

    /**
     * @param string $author
     * @return Content
     */
    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string
     */
    public function getLicense(): ?string
    {
        return $this->license;
    }

    /**
     * @param string $license
     * @return Content
     */
    public function setLicense(string $license): self
    {
        $this->license = $license;
        return $this;
    }

    /**
     * @return string
     */
    public function getKeywords(): string
    {
        return (string)$this->keywords;
    }

    /**
     * @param string $keywords
     * @return Content
     */
    public function setKeywords(string $keywords): self
    {
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return (string)$this->description;
    }

    /**
     * @param string $description
     * @return Content
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getZippedContentFile(): string
    {
        return (string)$this->zippedContentFile;
    }

    /**
     * @param string $zippedContentFile
     * @return Content
     */
    public function setZippedContentFile(string $zippedContentFile): self
    {
        $this->zippedContentFile = $zippedContentFile;
        return $this;
    }

    /**
     * @return string
     */
    public function getExportFile(): string
    {
        return (string)$this->exportFile;
    }

    /**
     * @param string $exportFile
     * @return Content
     */
    public function setExportFile(string $exportFile): self
    {
        $this->exportFile = $exportFile;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSource(): ?string
    {
        return $this->source;
    }

    /**
     * @param string|null $source
     * @return Content
     */
    public function setSource(?string $source): self
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getYearFrom(): ?int
    {
        return $this->yearFrom;
    }

    /**
     * @param int|null $yearFrom
     * @return Content
     */
    public function setYearFrom(?int $yearFrom): self
    {
        $this->yearFrom = $yearFrom;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getYearTo(): ?int
    {
        return $this->yearTo;
    }

    /**
     * @param int|null $yearTo
     * @return Content
     */
    public function setYearTo(?int $yearTo): self
    {
        $this->yearTo = $yearTo;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLicenseVersion(): ?string
    {
        return $this->licenseVersion;
    }

    /**
     * @param string|null $licenseVersion
     * @return Content
     */
    public function setLicenseVersion(?string $licenseVersion): self
    {
        $this->licenseVersion = $licenseVersion;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLicenseExtras(): ?string
    {
        return $this->licenseExtras;
    }

    /**
     * @param string|null $licenseExtras
     * @return Content
     */
    public function setLicenseExtras(?string $licenseExtras): self
    {
        $this->licenseExtras = $licenseExtras;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthorComments(): ?string
    {
        return $this->authorComments;
    }

    /**
     * @param string|null $authorComments
     * @return Content
     */
    public function setAuthorComments(?string $authorComments): self
    {
        $this->authorComments = $authorComments;
        return $this;
    }

    /**
     * @return string
     */
    public function getChanges(): string
    {
        return (string)$this->changes;
    }

    /**
     * @param string $changes
     * @return Content
     */
    public function setChanges(string $changes): self
    {
        $this->changes = $changes;
        return $this;
    }

    /**
     * Creates a Content from a metadata array.
     *
     * @param array $contentData
     * @param Library $library
     * @param int $account
     * @return Content
     */
    public static function createFromMetadata(array $contentData, Library $library, int $account): Content
    {
        $content = new Content();
        $content->setLibrary($library)
            ->setAccount($account)
            ->setCreatedAt(time())
            ->setUpdatedAt(time())
            ->setTitle($contentData['title'])
            ->setParameters($contentData['params'])
            ->setFiltered('')
            ->setDisable($contentData['disable'])
            ->setLicense($contentData['metadata']->license ?? '')
            ->setAuthor(json_encode($contentData['metadata']->authors))
            ->setChanges(json_encode($contentData['metadata']->changes))
            ->setSlug(''); // Set by h5p later, but must not be null
        /**
         * @see Library::updateFromMetadata()
         */
        $content->determineEmbedType();

        return $content;
    }

    /**
     * Updates a Content from a metadata array.
     *
     * @param array $contentData
     * @param Library $library
     * @return void
     */
    public function updateFromMetadata(array $contentData, Library $library): void
    {
        $this->setUpdatedAt(time())
            ->setTitle($contentData['title'])
            ->setFiltered('')
            ->setLibrary($library);

        if (isset($contentData['params'])) {
            $this->setParameters($contentData['params']);
        }
        if (isset($contentData['disable'])) {
            $this->setDisable($contentData['disable']);
        }
    }

    /**
     * @return void
     */
    public function determineEmbedType(): void
    {
        $this->setEmbedType(
            \H5PCore::determineEmbedType('div', $this->getLibrary()->getEmbedTypes())
        );
    }

    /**
     * Returns an associative array containing the content in the form that
     * \H5PCore->filterParameters() expects.
     * @see H5PCore::filterParameters()
     */
    public function toAssocArray(): array
    {
        return [
            'id' => $this->getUid(),
            'title' => $this->getTitle(),
            'library' => $this->getLibrary()->toAssocArray(),
            'slug' => $this->getSlug(),
            'disable' => $this->getDisable(),
            'embedType' => $this->getEmbedType(),
            'params' => $this->getParameters(),
            'filtered' => $this->getFiltered(),
            'metadata' => [
                'title' => $this->getTitle() ?? 'null',
                'authors' => $this->getAuthor() ?? 'null',
                'source' => $this->getSource() ?? '',
                'license' => $this->getLicense() ?? 'null',
                'licenseVersion' => $this->getLicenseVersion() ?? 'null',
                'licenseExtras' => $this->getLicenseExtras() ?? 'null',
                'yearFrom' => $this->getYearFrom() ?? 'null',
                'yearTo' => $this->getYearTo() ?? 'null',
                'changes' => $this->getChanges() ?? 'null',
                'authorComments' => $this->getAuthorComments() ?? 'null',
            ],
        ];
    }
}
