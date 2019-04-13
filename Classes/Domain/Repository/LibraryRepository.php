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

use LMS3\Lms3h5p\Domain\Model\Library;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * The repository for Library
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class LibraryRepository extends Repository
{
    const LIBRARY_TABLE_NAME = 'tx_lms3h5p_domain_model_library';

    /**
     * @var array
     */
    protected $defaultOrderings = [
        'name' => QueryInterface::ORDER_DESCENDING,
        'majorVersion' => QueryInterface::ORDER_DESCENDING,
        'minorVersion' => QueryInterface::ORDER_DESCENDING
    ];

    /**
     * Find latest library versions
     *
     * @return array
     */
    public function findLatestLibraryVersions(): array
    {
        $query = $this->createQuery();
        $tableName = self::LIBRARY_TABLE_NAME;
        $majorVersionSql = "SELECT lib1.name, MAX(lib1.major_version) AS major_version
            FROM  {$tableName} lib1
            WHERE lib1.runnable = 1 GROUP BY lib1.name";

        $minorVersionSql = "SELECT lib2.name, lib2.major_version, MAX(lib2.minor_version) AS minor_version
            FROM ({$majorVersionSql}) lib1
            JOIN {$tableName} lib2
            ON lib1.name = lib2.name AND lib1.major_version = lib2.major_version
            GROUP BY lib2.name, lib2.major_version";

        $finalSql = "SELECT lib4.uid as id, lib4.name AS machine_name, lib4.title, lib4.major_version, lib4.minor_version,
            lib4.patch_version, lib4.restricted, lib4.has_icon
            FROM ({$minorVersionSql}) lib3
            JOIN {$tableName} lib4
            ON lib3.name = lib4.name
            AND lib3.major_version = lib4.major_version
            AND lib3.minor_version = lib4.minor_version";

        $query->statement($finalSql);

        return $query->execute(true);
    }

    /**
     * Check if library has upgrade
     *
     * @param array $library
     * @return bool
     * @throws InvalidQueryException
     */
    public function libraryHasUpgrade(array $library): bool
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('name', $library['machineName']),
                $query->logicalOr(
                    $query->greaterThan('majorVersion', $library['majorVersion']),
                    $query->logicalAnd(
                        $query->equals('majorVersion', $library['majorVersion']),
                        $query->greaterThan('minorVersion', $library['minorVersion'])
                    )
                )
            )
        )->setLimit(1);

        return $query->execute()->count() === 1;
    }


    /**
     * Check if is patched library
     *
     * @param array $criteria
     * @return bool
     */
    public function isPatchedLibrary(array $criteria): bool
    {
        try {
            $query = $this->createQuery();
            $conditions = [];
            foreach ($criteria as $key => $value) {
                if ('patchVersion' === $key) {
                    $conditions[] = $query->lessThan($key, $value);
                } else {
                    $conditions[] = $query->equals($key, $value);
                }
            }

            return $query->matching($query->logicalAnd($conditions))->execute()->count() > 0;
        } catch (InvalidQueryException $exception) {
            return true;
        }
    }

    /**
     * Find one by name. major version and minor version
     *
     * @param string $libraryName
     * @param int $majorVersion
     * @param int $minorVersion
     * @return \LMS3\Lms3h5p\Domain\Model\Library
     */
    public function findOneByNameMajorVersionAndMinorVersion(string $libraryName,
                                                             int $majorVersion,
                                                             int $minorVersion): ?Library
    {
        $query = $this->createQuery();

        $query->matching($query->logicalAnd(
            $query->equals('name', $libraryName),
            $query->equals('majorVersion', $majorVersion),
            $query->equals('minorVersion', $minorVersion)
        ));

        return $query->execute()->getFirst();
    }

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

    /**
     * Remove by library id
     *
     * @param int $id
     * @return void
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     */
    public function removeById($id): void
    {
        $library = $this->findByUid($id);
        if ($library !== null) {
            $this->remove($library);
        }
    }

    /**
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findAddOns()
    {
        // TODO: find addon libraries
    }
}