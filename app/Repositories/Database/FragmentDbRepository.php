<?php

namespace App\Repositories\Database;

use App\Models\Fragment;
use App\Repositories\FragmentRepository;

class FragmentDbRepository extends DbRepository implements FragmentRepository
{
    public function __construct()
    {
        $this->model = new Fragment();
    }

    /**
     * Get all models excluding drafts.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->newQuery()->orderBy('name')->get();
    }

    /**
     * Find a fragment by it's name.
     *
     * @param string $name
     *
     * @return \App\Models\Fragment
     */
    public function findByName($name)
    {
        return $this->model->newQuery()->where('name', $name)->with('translations')->first();
    }

    /**
     * Get the base database query.
     *
     * @throws \Exception
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        throw new \Exception('not implemented');
    }
}
