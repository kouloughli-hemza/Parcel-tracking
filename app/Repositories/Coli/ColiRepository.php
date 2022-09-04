<?php

namespace Dsone\Repositories\Coli;

use Carbon\Carbon;
use Dsone\Coli;

interface ColiRepository
{
    /**
     * Paginate registered colis.
     *
     * @param $perPage
     * @param null $search
     * @param null $status
     * @return mixed
     */
    public function paginate($perPage, $search = null, $status = null);

    /**
     * Find coli by its id.
     *
     * @param $id
     * @return null|Coli
     */
    public function find($id);


    /**
     * Create new coli.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update coli specified by it's id.
     *
     * @param $id
     * @param array $data
     * @return Coli
     */
    public function update($id, array $data);

    /**
     * Delete coli with provided id.
     *
     * @param $id
     * @return mixed
     */
    public function delete($id);


    /**
     * Number of colis in database.
     *
     * @return mixed
     */
    public function count();

    /**
     * Number of colis registered during current month.
     *
     * @return mixed
     */
    public function newColisCount();


    /**
     * Count of registered colis for every month within the
     * provided date range.
     *
     * @param $from
     * @param $to
     * @return mixed
     */
    public function countOfNewColisPerMonth(Carbon $from, Carbon $to);

    /**
     * Get latest {$count} colis from database.
     *
     * @param $count
     * @return mixed
     */
    public function latest($count = 20);


    /**
     * @return mixed
     */
    public function generateTrackingNumber();


    /**
     * @param $request
     * @return mixed
     */
    public function createColisClient($request);

    /**
     * @return mixed
     */
    public function getNextID();


}
