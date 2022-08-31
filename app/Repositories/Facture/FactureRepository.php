<?php

namespace Dsone\Repositories\Facture;

use Carbon\Carbon;
use Dsone\Facture;

interface FactureRepository
{
    /**
     * Paginate registered users.
     *
     * @param $perPage
     * @param null $search
     * @param null $status
     * @return mixed
     */
    public function paginate($perPage, $search = null, $status = null);

    /**
     * Find user by its id.
     *
     * @param $id
     * @return null|Facture
     */
    public function find($id);


    /**
     * Create new user.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update user specified by it's id.
     *
     * @param $id
     * @param array $data
     * @return Facture
     */
    public function update($id, array $data);

    /**
     * Delete user with provided id.
     *
     * @param $id
     * @return mixed
     */
    public function delete($id);


    /**
     * Number of users in database.
     *
     * @return mixed
     */
    public function count();

    /**
     * Number of users registered during current month.
     *
     * @return mixed
     */
    public function newFacturesCount();


    /**
     * Count of registered users for every month within the
     * provided date range.
     *
     * @param $from
     * @param $to
     * @return mixed
     */
    public function countOfNewFacturesPerMonth(Carbon $from, Carbon $to);

    /**
     * Get latest {$count} users from database.
     *
     * @param $count
     * @return mixed
     */
    public function latest($count = 20);


    /**
     * @return mixed
     */
    public function createReference();


    /**
     * @return mixed
     */
    public function getNextID();


}
