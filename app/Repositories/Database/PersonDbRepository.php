<?php

namespace App\Repositories\Database;

use App\Models\Person;
use App\Repositories\PersonRepository;
use Illuminate\Database\Eloquent\Collection;

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
     * Set the new order.
     *
     * @param array $ids
     *
     * @throws \Spatie\EloquentSortable\SortableException
     */
    public function setNewOrder($ids)
    {
        $this->model->setNewOrder($ids);
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
