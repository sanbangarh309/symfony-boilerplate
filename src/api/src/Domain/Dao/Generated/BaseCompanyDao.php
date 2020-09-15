<?php
/**
 * This file has been automatically generated by TDBM.
 * DO NOT edit this file, as it might be overwritten.
 * If you need to perform changes, edit the CompanyDao class instead!
 */

declare(strict_types=1);

namespace App\Domain\Dao\Generated;

use App\Domain\Model\Company;
use TheCodingMachine\TDBM\TDBMService;
use TheCodingMachine\TDBM\ResultIterator;
use TheCodingMachine\TDBM\TDBMException;

/**
 * The BaseCompanyDao class will maintain the persistence of Company class into the
 * companies table.
 */
abstract class BaseCompanyDao
{

    /**
     * @var \TheCodingMachine\TDBM\TDBMService
     */
    public $tdbmService = null;

    /**
     * The default sort column.
     *
     * @var string|null
     */
    public $defaultSort = null;

    /**
     * The default sort direction.
     *
     * @var string
     */
    public $defaultDirection = 'asc';

    /**
     * Sets the TDBM service used by this DAO.
     */
    public function __construct(\TheCodingMachine\TDBM\TDBMService $tdbmService)
    {
        $this->tdbmService = $tdbmService;
    }

    /**
     * Persist the Company instance.
     *
     * @param Company $obj The bean to save.
     */
    public function save(\App\Domain\Model\Company $obj) : void
    {
        $this->tdbmService->save($obj);
    }

    /**
     * Get all Company records.
     */
    public function findAll() : \App\Domain\ResultIterator\CompanyResultIterator
    {
        if ($this->defaultSort) {
            $orderBy = 'companies.'.$this->defaultSort.' '.$this->defaultDirection;
        } else {
            $orderBy = null;
        }
        return $this->tdbmService->findObjects('companies', null, [], $orderBy, [], null, null, \App\Domain\ResultIterator\CompanyResultIterator::class);
    }

    /**
     * Get Company specified by its ID (its primary key).
     *
     * If the primary key does not exist, an exception is thrown.
     *
     * @param string $id
     * @param bool $lazyLoading If set to true, the object will not be loaded right away. Instead, it will be loaded when you first try to access a method of the object.
     * @return \App\Domain\Model\Company
     * @throws \TheCodingMachine\TDBM\TDBMException
     * @TheCodingMachine\GraphQLite\Annotations\Factory
     * @TheCodingMachine\GraphQLite\Annotations\HideParameter (for="$lazyLoading")
     */
    public function getById(string $id, bool $lazyLoading = false) : \App\Domain\Model\Company
    {
        return $this->tdbmService->findObjectByPk('companies', ['id' => $id], [], $lazyLoading);
    }

    /**
     * Get all Company records.
     *
     * @param \App\Domain\Model\Company $obj The object to delete
     * @param bool $cascade If true, it will delete all objects linked to $obj
     */
    public function delete(\App\Domain\Model\Company $obj, bool $cascade = false) : void
    {
        if ($cascade === true) {
            $this->tdbmService->deleteCascade($obj);
        } else {
            $this->tdbmService->delete($obj);
        }
    }

    /**
     * Get all Company records.
     *
     * @param mixed $filter The filter bag (see TDBMService::findObjects for complete description)
     * @param mixed[] $parameters The parameters associated with the filter
     * @param mixed $orderBy The order string
     * @param string[] $additionalTablesFetch A list of additional tables to fetch (for performance improvement)
     * @param int|null $mode Either TDBMService::MODE_ARRAY or TDBMService::MODE_CURSOR (for large datasets). Defaults to TDBMService::MODE_ARRAY.
     */
    protected function find($filter = null, array $parameters = [], $orderBy = null, array $additionalTablesFetch = [], ?int $mode = null) : \App\Domain\ResultIterator\CompanyResultIterator
    {
        if ($this->defaultSort && $orderBy == null) {
            $orderBy = 'companies.'.$this->defaultSort.' '.$this->defaultDirection;
        }
        return $this->tdbmService->findObjects('companies', $filter, $parameters, $orderBy, $additionalTablesFetch, $mode, null, \App\Domain\ResultIterator\CompanyResultIterator::class);
    }

    /**
     * Get a list of Company specified by its filters.
     *
     * Unlike the `find` method that guesses the FROM part of the statement, here you can pass the $from part.
     *
     * You should not put an alias on the main table name. So your $from variable should look like:
     *
     *    "companies JOIN ... ON ..."
     *
     * @param string $from The sql from statement
     * @param mixed $filter The filter bag (see TDBMService::findObjects for complete description)
     * @param mixed[] $parameters The parameters associated with the filter
     * @param mixed $orderBy The order string
     * @param string[] $additionalTablesFetch A list of additional tables to fetch (for performance improvement)
     * @param int|null $mode Either TDBMService::MODE_ARRAY or TDBMService::MODE_CURSOR (for large datasets). Defaults to TDBMService::MODE_ARRAY.
     */
    protected function findFromSql(string $from, $filter = null, array $parameters = [], $orderBy = null, array $additionalTablesFetch = [], ?int $mode = null) : \App\Domain\ResultIterator\CompanyResultIterator
    {
        if ($this->defaultSort && $orderBy == null) {
            $orderBy = 'companies.'.$this->defaultSort.' '.$this->defaultDirection;
        }
        return $this->tdbmService->findObjectsFromSql('companies', $from, $filter, $parameters, $orderBy, $mode, null, \App\Domain\ResultIterator\CompanyResultIterator::class);
    }

    /**
     * Get a list of Company from a SQL query.
     *
     * Unlike the `find` and `findFromSql` methods, here you can pass the whole $sql query.
     *
     * You should not put an alias on the main table name, and select its columns using `*`. So the SELECT part of you $sql should look like:
     *
     *    "SELECT companies .* FROM ..."
     *
     * @param string $sql The sql query
     * @param mixed[] $parameters The parameters associated with the query
     * @param string|null $countSql The sql query that provides total count of rows (automatically computed if not provided)
     * @param int|null $mode Either TDBMService::MODE_ARRAY or TDBMService::MODE_CURSOR (for large datasets). Defaults to TDBMService::MODE_ARRAY.
     */
    protected function findFromRawSql(string $sql, array $parameters = [], ?string $countSql = null, ?int $mode = null) : \App\Domain\ResultIterator\CompanyResultIterator
    {
        return $this->tdbmService->findObjectsFromRawSql('companies', $sql, $parameters, $mode, null, $countSql, \App\Domain\ResultIterator\CompanyResultIterator::class);
    }

    /**
     * Get a single Company specified by its filters.
     *
     * @param mixed $filter The filter bag (see TDBMService::findObjects for complete description)
     * @param mixed[] $parameters The parameters associated with the filter
     * @param string[] $additionalTablesFetch A list of additional tables to fetch (for performance improvement)
     * @return \App\Domain\Model\Company|null
     */
    protected function findOne($filter = null, array $parameters = [], array $additionalTablesFetch = []) : ?\App\Domain\Model\Company
    {
        return $this->tdbmService->findObject('companies', $filter, $parameters, $additionalTablesFetch);
    }

    /**
     * Get a single Company specified by its filters.
     *
     * Unlike the `findOne` method that guesses the FROM part of the statement, here you can pass the $from part.
     *
     * You should not put an alias on the main table name. So your $from variable should look like:
     *
     *     "companies JOIN ... ON ..."
     *
     * @param string $from The sql from statement
     * @param mixed $filter The filter bag (see TDBMService::findObjects for complete description)
     * @param mixed[] $parameters The parameters associated with the filter
     * @return \App\Domain\Model\Company|null
     */
    protected function findOneFromSql(string $from, $filter = null, array $parameters = []) : ?\App\Domain\Model\Company
    {
        return $this->tdbmService->findObjectFromSql('companies', $from, $filter, $parameters);
    }

    /**
     * Sets the default column for default sorting.
     *
     * @param string $defaultSort
     */
    public function setDefaultSort(string $defaultSort) : void
    {
        $this->defaultSort = $defaultSort;
    }

    /**
     * Get a Company filtered by name.
     *
     * @param string $name
     * @param string[] $additionalTablesFetch A list of additional tables to fetch (for performance improvement)
     * @return \App\Domain\Model\Company|null
     */
    public function findOneByName(string $name, array $additionalTablesFetch = []) : ?\App\Domain\Model\Company
    {
        $filter = [
                    'name' => $name,
                ];
        return $this->findOne($filter, [], $additionalTablesFetch);
    }
}
