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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Content Type Cache Entry
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class ContentTypeCacheEntry extends AbstractEntity
{
    /**
     * @var string
     */
    protected $machineName;

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
     * @var int
     */
    protected $h5pMajorVersion;

    /**
     * @var int
     */
    protected $h5pMinorVersion;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $summary;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $icon;

    /**
     * @var int
     */
    protected $createdAt;

    /**
     * @var int
     */
    protected $updatedAt;

    /**
     * @var bool
     */
    protected $isRecommended;

    /**
     * @var int
     */
    protected $popularity;

    /**
     * @var string
     */
    protected $screenshots;

    /**
     * @var string
     */
    protected $license;

    /**
     * @var string
     */
    protected $example;

    /**
     * @var string
     */
    protected $tutorial;

    /**
     * @var string
     */
    protected $keywords;

    /**
     * @var string
     */
    protected $categories;

    /**
     * @var string
     */
    protected $owner;

    /**
     * @return string
     */
    public function getMachineName(): string
    {
        return $this->machineName;
    }

    /**
     * @param string $machineName
     * @return ContentTypeCacheEntry
     */
    public function setMachineName(string $machineName): ContentTypeCacheEntry
    {
        $this->machineName = $machineName;
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
     * @return ContentTypeCacheEntry
     */
    public function setMajorVersion(int $majorVersion): ContentTypeCacheEntry
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
     * @return ContentTypeCacheEntry
     */
    public function setMinorVersion(int $minorVersion): ContentTypeCacheEntry
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
     * @return ContentTypeCacheEntry
     */
    public function setPatchVersion(int $patchVersion): ContentTypeCacheEntry
    {
        $this->patchVersion = $patchVersion;
        return $this;
    }

    /**
     * @return int
     */
    public function getH5pMajorVersion(): int
    {
        return $this->h5pMajorVersion;
    }

    /**
     * @param int $h5pMajorVersion
     * @return ContentTypeCacheEntry
     */
    public function setH5pMajorVersion(int $h5pMajorVersion): ContentTypeCacheEntry
    {
        $this->h5pMajorVersion = $h5pMajorVersion;
        return $this;
    }

    /**
     * @return int
     */
    public function getH5pMinorVersion(): int
    {
        return $this->h5pMinorVersion;
    }

    /**
     * @param int $h5pMinorVersion
     * @return ContentTypeCacheEntry
     */
    public function setH5pMinorVersion(int $h5pMinorVersion): ContentTypeCacheEntry
    {
        $this->h5pMinorVersion = $h5pMinorVersion;
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
     * @return ContentTypeCacheEntry
     */
    public function setTitle(string $title): ContentTypeCacheEntry
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     * @return ContentTypeCacheEntry
     */
    public function setSummary(string $summary): ContentTypeCacheEntry
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return ContentTypeCacheEntry
     */
    public function setDescription(string $description): ContentTypeCacheEntry
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     * @return ContentTypeCacheEntry
     */
    public function setIcon(string $icon): ContentTypeCacheEntry
    {
        $this->icon = $icon;
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
     * @return ContentTypeCacheEntry
     */
    public function setCreatedAt(int $createdAt): ContentTypeCacheEntry
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
     * @return ContentTypeCacheEntry
     */
    public function setUpdatedAt(int $updatedAt): ContentTypeCacheEntry
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRecommended(): bool
    {
        return $this->isRecommended;
    }

    /**
     * @param bool $isRecommended
     * @return ContentTypeCacheEntry
     */
    public function setIsRecommended(bool $isRecommended): ContentTypeCacheEntry
    {
        $this->isRecommended = $isRecommended;
        return $this;
    }

    /**
     * @return int
     */
    public function getPopularity(): int
    {
        return $this->popularity;
    }

    /**
     * @param int $popularity
     * @return ContentTypeCacheEntry
     */
    public function setPopularity(int $popularity): ContentTypeCacheEntry
    {
        $this->popularity = $popularity;
        return $this;
    }

    /**
     * @return string
     */
    public function getScreenshots(): string
    {
        return $this->screenshots;
    }

    /**
     * @param string $screenshots
     * @return ContentTypeCacheEntry
     */
    public function setScreenshots(string $screenshots): ContentTypeCacheEntry
    {
        $this->screenshots = $screenshots;
        return $this;
    }

    /**
     * @return string
     */
    public function getLicense(): string
    {
        return $this->license;
    }

    /**
     * @param string $license
     * @return ContentTypeCacheEntry
     */
    public function setLicense(string $license): ContentTypeCacheEntry
    {
        $this->license = $license;
        return $this;
    }

    /**
     * @return string
     */
    public function getExample(): string
    {
        return $this->example;
    }

    /**
     * @param string $example
     * @return ContentTypeCacheEntry
     */
    public function setExample(string $example): ContentTypeCacheEntry
    {
        $this->example = $example;
        return $this;
    }

    /**
     * @return string
     */
    public function getTutorial(): string
    {
        return $this->tutorial;
    }

    /**
     * @param string $tutorial
     * @return ContentTypeCacheEntry
     */
    public function setTutorial(string $tutorial): ContentTypeCacheEntry
    {
        $this->tutorial = $tutorial;
        return $this;
    }

    /**
     * @return string
     */
    public function getKeywords(): string
    {
        return $this->keywords;
    }

    /**
     * @param string $keywords
     * @return ContentTypeCacheEntry
     */
    public function setKeywords(string $keywords): ContentTypeCacheEntry
    {
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategories(): string
    {
        return $this->categories;
    }

    /**
     * @param string $categories
     * @return ContentTypeCacheEntry
     */
    public function setCategories(string $categories): ContentTypeCacheEntry
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * @param string $owner
     * @return ContentTypeCacheEntry
     */
    public function setOwner(string $owner): ContentTypeCacheEntry
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * Create content type cache entry object
     *
     * @param \stdClass $contentTypeCacheObject
     * @return ContentTypeCacheEntry
     */
    public static function create(\stdClass $contentTypeCacheObject): self
    {
        $createdAt = new \DateTime($contentTypeCacheObject->createdAt);
        $updatedAt = new \DateTime($contentTypeCacheObject->updatedAt);
        $entry = new ContentTypeCacheEntry();
        $entry->setMachineName($contentTypeCacheObject->id)
            ->setMajorVersion($contentTypeCacheObject->version->major)
            ->setMinorVersion($contentTypeCacheObject->version->minor)
            ->setPatchVersion($contentTypeCacheObject->version->patch)
            ->setH5pMajorVersion($contentTypeCacheObject->coreApiVersionNeeded->major)
            ->setH5pMinorVersion($contentTypeCacheObject->coreApiVersionNeeded->minor)
            ->setTitle($contentTypeCacheObject->title)
            ->setSummary($contentTypeCacheObject->summary)
            ->setDescription($contentTypeCacheObject->description)
            ->setIcon($contentTypeCacheObject->icon)
            ->setCreatedAt($createdAt->getTimestamp())
            ->setUpdatedAt($updatedAt->getTimestamp())
            ->setIsRecommended($contentTypeCacheObject->isRecommended)
            ->setPopularity($contentTypeCacheObject->popularity)
            ->setScreenshots(
                json_encode($contentTypeCacheObject->screenshots)
            )
            ->setLicense(
                json_encode(isset($contentTypeCacheObject->license) ? $contentTypeCacheObject->license : [])
            )
            ->setExample($contentTypeCacheObject->example)
            ->setTutorial(
                isset($contentTypeCacheObject->tutorial) ? $contentTypeCacheObject->tutorial : ''
            )
            ->setKeywords(
                json_encode(isset($contentTypeCacheObject->keywords) ? $contentTypeCacheObject->keywords : [])
            )
            ->setCategories(
                json_encode(isset($contentTypeCacheObject->categories) ? $contentTypeCacheObject->categories : [])
            )
            ->setOwner($contentTypeCacheObject->owner);

        return $entry;
    }

    /**
     * Returns the library cache entry in a format that H5P expects.
     *
     * @return \stdClass
     */
    public function toStdClass(): \stdClass
    {
        return (object)[
            'id' => $this->getUid(),
            'machine_name' => $this->getMachineName(),
            'major_version' => $this->getMajorVersion(),
            'minor_version' => $this->getMinorVersion(),
            'patch_version' => $this->getPatchVersion(),
            'h5p_major_version' => $this->getH5pMajorVersion(),
            'h5p_minor_version' => $this->getH5pMinorVersion(),
            'title' => $this->getTitle(),
            'summary' => $this->getSummary(),
            'description' => $this->getDescription(),
            'icon' => $this->getIcon(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
            'is_recommended' => $this->isRecommended(),
            'popularity' => $this->getPopularity(),
            'screenshots' => $this->getScreenshots(),
            'license' => $this->getLicense(),
            'owner' => $this->getOwner()
        ];
    }

}