<?php
declare(strict_types = 1);

namespace LMS3\Lms3h5p\Domain\Repository;

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

use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * The repository for content dependency
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class ContentDependencyRepository extends Repository
{
    /**
     * Find records by condition
     *
     * @param array $criteria
     * @param array $ordering
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByConditions(array $criteria, array $ordering = [])
    {
        $query = $this->createQuery();
        if (!empty($ordering)) {
            $query->setOrderings($ordering);
        }
        if (empty($criteria)) {
            return $query->execute();
        }
        $conditions = [];
        foreach ($criteria as $key => $value) {
            $conditions[] = $query->equals($key, $value);
        }
        return $query->matching($query->logicalAnd($conditions))->execute();
    }
}