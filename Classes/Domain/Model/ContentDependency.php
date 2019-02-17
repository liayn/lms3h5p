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
 * Content Dependency
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class ContentDependency extends AbstractEntity
{
    /**
     * @var \LMS3\Lms3h5p\Domain\Model\Content
     */
    protected $content;

    /**
     * @var \LMS3\Lms3h5p\Domain\Model\Library
     */
    protected $library;

    /**
     * @var string
     */
    protected $dependencyType;

    /**
     * @var int
     */
    protected $weight;

    /**
     * @var bool
     */
    protected $dropCss;

    /**
     * @return Content
     */
    public function getContent(): Content
    {
        return $this->content;
    }

    /**
     * @param Content $content
     * @return ContentDependency
     */
    public function setContent(Content $content): ContentDependency
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return Library
     */
    public function getLibrary(): Library
    {
        return $this->library;
    }

    /**
     * @param Library $library
     * @return ContentDependency
     */
    public function setLibrary(Library $library): ContentDependency
    {
        $this->library = $library;
        return $this;
    }

    /**
     * @return string
     */
    public function getDependencyType(): string
    {
        return $this->dependencyType;
    }

    /**
     * @param string $dependencyType
     * @return ContentDependency
     */
    public function setDependencyType(string $dependencyType): ContentDependency
    {
        $this->dependencyType = $dependencyType;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     * @return ContentDependency
     */
    public function setWeight(int $weight): ContentDependency
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDropCss(): bool
    {
        return $this->dropCss;
    }

    /**
     * @param bool $dropCss
     * @return ContentDependency
     */
    public function setDropCss(bool $dropCss): ContentDependency
    {
        $this->dropCss = $dropCss;
        return $this;
    }

    /**
     * Returns an assoc array as expected by
     * @see \H5PCore::getDependenciesFiles
     *
     * @return array
     */
    public function toAssocArray(): array
    {
        // Not all fields from library are expected in this array, but we don't expect conflicts here.
        $libraryData = $this->getLibrary()->toAssocArray();
        return array_merge($libraryData, [
            'dropCss' => $this->isDropCss(),
            'dependencyType' => $this->getDependencyType()
        ]);
    }
}