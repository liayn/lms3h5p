<?php

declare(strict_types=1);

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
 * Library Dependency
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class LibraryDependency extends AbstractEntity
{
    /**
     * @var Library
     */
    protected $uidLocal;

    /**
     * @var Library
     */
    protected $uidForeign;

    /**
     * @var string
     */
    protected $dependencyType;

    /**
     * @return Library
     */
    public function getLibrary(): Library
    {
        return $this->uidLocal;
    }

    /**
     * @param Library $library
     * @return LibraryDependency
     */
    public function setLibrary(Library $library): LibraryDependency
    {
        $this->uidLocal = $library;
        return $this;
    }

    /**
     * @return Library
     */
    public function getRequiredLibrary(): Library
    {
        return $this->uidForeign;
    }

    /**
     * @param Library $requiredLibrary
     * @return LibraryDependency
     */
    public function setRequiredLibrary(Library $requiredLibrary): LibraryDependency
    {
        $this->uidForeign = $requiredLibrary;
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
     * @return LibraryDependency
     */
    public function setDependencyType(string $dependencyType): LibraryDependency
    {
        $this->dependencyType = $dependencyType;
        return $this;
    }
}
