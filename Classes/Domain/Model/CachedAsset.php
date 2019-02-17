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
 * Cached Asset
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class CachedAsset extends AbstractEntity
{
    /**
     * @var \LMS3\Lms3h5p\Domain\Model\Library
     */
    protected $library;

    /**
     * @var string
     */
    protected $hashKey;

    /**
     * @var string
     */
    protected $type;

    /**
     * @return \LMS3\Lms3h5p\Domain\Model\Library
     */
    public function getLibrary(): Library
    {
        return $this->library;
    }

    /**
     * @param \LMS3\Lms3h5p\Domain\Model\Library $library
     * @return CachedAsset
     */
    public function setLibrary(Library $library): self
    {
        $this->library = $library;
        return $this;
    }

    /**
     * @return string
     */
    public function getHashKey(): string
    {
        return $this->hashKey;
    }

    /**
     * @param string $hashKey
     * @return CachedAsset
     */
    public function setHashKey(string $hashKey): self
    {
        $this->hashKey = $hashKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return CachedAsset
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }
}