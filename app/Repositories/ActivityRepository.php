<?php

namespace App\Repositories;

interface ActivityRepository extends Repository
{
    /**
     * @param int $number
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLatest($number = 30);

    /**
     * @param int $perPage
     *
     * @return \Illuminate\Database\Eloquent
     */
    public function getPaginator($perPage = 100);
}
