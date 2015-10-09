<?php

namespace App\Repositories\Database;

use App\Repositories\ActivityRepository;
use Spatie\Activitylog\Models\Activity;

class ActivityDbRepository extends DbRepository implements ActivityRepository
{
    public function __construct()
    {
        $this->model = new Activity();
    }

    /**
     * @param int $number
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLatest($number = 30)
    {
        return $this->query()->latest()->limit($number)->get();
    }

    /**
     * @param int $perPage
     *
     * @return \Illuminate\Database\Eloquent
     */
    public function getPaginator($perPage = 100)
    {
        return $this->query()->orderBy('created_at', 'DESC')->paginate($perPage);
    }

    /**
     * Get the base database query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->with('user');
    }
}
