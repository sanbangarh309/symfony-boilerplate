<?php
/**
 * This file has been automatically generated by TDBM.
 * DO NOT edit this file, as it might be overwritten.
 * If you need to perform changes, edit the PaymentDao class instead!
 */

declare(strict_types=1);

namespace App\Domain\Dao\Generated;

use App\Domain\Model\Payment;
use TheCodingMachine\TDBM\TDBMService;
use TheCodingMachine\TDBM\ResultIterator;
use TheCodingMachine\TDBM\TDBMException;

/**
 * The BasePaymentDao class will maintain the persistence of Payment class into the
 * payments table.
 */
abstract class BasePaymentDao
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
     * Persist the Payment instance.
     *
     * @param Payment $obj The bean to save.
     */
    public function save(\App\Domain\Model\Payment $obj) : void
    {
        $this->tdbmService->save($obj);
    }

    /**
     * Get all Payment records.
     */
    public function findAll() : \App\Domain\ResultIterator\PaymentResultIterator
    {
        if ($this->defaultSort) {
            $orderBy = 'payments.'.$this->defaultSort.' '.$this->defaultDirection;
        } else {
            $orderBy = null;
        }
        return $this->tdbmService->findObjects('payments', null, [], $orderBy, [], null, \App\Domain\Model\Payment::class, \App\Domain\ResultIterator\PaymentResultIterator::class);
    }

    /**
     * Get Payment specified by its ID (its primary key).
     *
     * If the primary key does not exist, an exception is thrown.
     *
     * @param string $id
     * @param bool $lazyLoading If set to true, the object will not be loaded right away. Instead, it will be loaded when you first try to access a method of the object.
     * @return \App\Domain\Model\Payment
     * @throws \TheCodingMachine\TDBM\TDBMException
     */
    public function getById(string $id, bool $lazyLoading = false) : \App\Domain\Model\Payment
    {
        return $this->tdbmService->findObjectByPk('payments', ['id' => $id], [], $lazyLoading, \App\Domain\Model\Payment::class, \App\Domain\ResultIterator\PaymentResultIterator::class);
    }

    /**
     * Get all Payment records.
     *
     * @param \App\Domain\Model\Payment $obj The object to delete
     * @param bool $cascade If true, it will delete all objects linked to $obj
     */
    public function delete(\App\Domain\Model\Payment $obj, bool $cascade = false) : void
    {
        if ($cascade === true) {
            $this->tdbmService->deleteCascade($obj);
        } else {
            $this->tdbmService->delete($obj);
        }
    }

    /**
     * Get all Payment records.
     *
     * @param mixed $filter The filter bag (see TDBMService::findObjects for complete description)
     * @param mixed[] $parameters The parameters associated with the filter
     * @param mixed $orderBy The order string
     * @param string[] $additionalTablesFetch A list of additional tables to fetch (for performance improvement)
     * @param int|null $mode Either TDBMService::MODE_ARRAY or TDBMService::MODE_CURSOR (for large datasets). Defaults to TDBMService::MODE_ARRAY.
     */
    protected function find($filter = null, array $parameters = [], $orderBy = null, array $additionalTablesFetch = [], ?int $mode = null) : \App\Domain\ResultIterator\PaymentResultIterator
    {
        if ($this->defaultSort && $orderBy == null) {
            $orderBy = 'payments.'.$this->defaultSort.' '.$this->defaultDirection;
        }
        return $this->tdbmService->findObjects('payments', $filter, $parameters, $orderBy, $additionalTablesFetch, $mode, \App\Domain\Model\Payment::class, \App\Domain\ResultIterator\PaymentResultIterator::class);
    }

    /**
     * Get a list of Payment specified by its filters.
     *
     * Unlike the `find` method that guesses the FROM part of the statement, here you can pass the $from part.
     *
     * You should not put an alias on the main table name. So your $from variable should look like:
     *
     *    "payments JOIN ... ON ..."
     *
     * @param string $from The sql from statement
     * @param mixed $filter The filter bag (see TDBMService::findObjects for complete description)
     * @param mixed[] $parameters The parameters associated with the filter
     * @param mixed $orderBy The order string
     * @param string[] $additionalTablesFetch A list of additional tables to fetch (for performance improvement)
     * @param int|null $mode Either TDBMService::MODE_ARRAY or TDBMService::MODE_CURSOR (for large datasets). Defaults to TDBMService::MODE_ARRAY.
     */
    protected function findFromSql(string $from, $filter = null, array $parameters = [], $orderBy = null, array $additionalTablesFetch = [], ?int $mode = null) : \App\Domain\ResultIterator\PaymentResultIterator
    {
        if ($this->defaultSort && $orderBy == null) {
            $orderBy = 'payments.'.$this->defaultSort.' '.$this->defaultDirection;
        }
        return $this->tdbmService->findObjectsFromSql('payments', $from, $filter, $parameters, $orderBy, $mode, \App\Domain\Model\Payment::class, \App\Domain\ResultIterator\PaymentResultIterator::class);
    }

    /**
     * Get a list of Payment from a SQL query.
     *
     * Unlike the `find` and `findFromSql` methods, here you can pass the whole $sql query.
     *
     * You should not put an alias on the main table name, and select its columns using `*`. So the SELECT part of you $sql should look like:
     *
     *    "SELECT payments .* FROM ..."
     *
     * @param string $sql The sql query
     * @param mixed[] $parameters The parameters associated with the query
     * @param string|null $countSql The sql query that provides total count of rows (automatically computed if not provided)
     * @param int|null $mode Either TDBMService::MODE_ARRAY or TDBMService::MODE_CURSOR (for large datasets). Defaults to TDBMService::MODE_ARRAY.
     */
    protected function findFromRawSql(string $sql, array $parameters = [], ?string $countSql = null, ?int $mode = null) : \App\Domain\ResultIterator\PaymentResultIterator
    {
        return $this->tdbmService->findObjectsFromRawSql('payments', $sql, $parameters, $mode, \App\Domain\Model\Payment::class, $countSql, \App\Domain\ResultIterator\PaymentResultIterator::class);
    }

    /**
     * Get a single Payment specified by its filters.
     *
     * @param mixed $filter The filter bag (see TDBMService::findObjects for complete description)
     * @param mixed[] $parameters The parameters associated with the filter
     * @param string[] $additionalTablesFetch A list of additional tables to fetch (for performance improvement)
     * @return \App\Domain\Model\Payment|null
     */
    protected function findOne($filter = null, array $parameters = [], array $additionalTablesFetch = []) : ?\App\Domain\Model\Payment
    {
        return $this->tdbmService->findObject('payments', $filter, $parameters, $additionalTablesFetch, \App\Domain\Model\Payment::class, \App\Domain\ResultIterator\PaymentResultIterator::class);
    }

    /**
     * Get a single Payment specified by its filters.
     *
     * Unlike the `findOne` method that guesses the FROM part of the statement, here you can pass the $from part.
     *
     * You should not put an alias on the main table name. So your $from variable should look like:
     *
     *     "payments JOIN ... ON ..."
     *
     * @param string $from The sql from statement
     * @param mixed $filter The filter bag (see TDBMService::findObjects for complete description)
     * @param mixed[] $parameters The parameters associated with the filter
     * @return \App\Domain\Model\Payment|null
     */
    protected function findOneFromSql(string $from, $filter = null, array $parameters = []) : ?\App\Domain\Model\Payment
    {
        return $this->tdbmService->findObjectFromSql('payments', $from, $filter, $parameters, \App\Domain\Model\Payment::class, \App\Domain\ResultIterator\PaymentResultIterator::class);
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
}
