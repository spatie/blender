<?php

namespace App\Repositories\Database;

use App\Models\Person;
use App\Repositories\PersonRepository;

class PersonDbRepository extends DbRepository implements PersonRepository
{
    public function __construct()
    {
        $this->model = new Person();
    }

    /**
     * Get all models excluding drafts.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->query()->get();
    }

    /**
     * Get all online models.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllOnline()
    {
        return $this->query()->online()->get();
    }

    /**
     * Get all online models with a certain type.
     *
     * @param string $type
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWithType($type)
    {
        return $this->query()->where('type', $type)->online()->get();
    }

    /**
     * Get a person from his url.
     *
     * @param string $url
     *
     * @return \App\Models\Person
     */
    public function findByUrl($url)
    {
        return $this->model->where('url', $url)->first();
    }

    /**
     * Get the base database query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model
            ->newQuery()
            ->with(['translations'])
            ->orderBy('order_column')
            ->nonDraft();
    }
}
