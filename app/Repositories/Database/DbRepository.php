<?php

namespace App\Repositories\Database;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Spatie\OrAbort\OrAbort;

abstract class DbRepository implements Repository
{
    use OrAbort;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Fetch all records.
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Fetch a record by id.
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Save the model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function save(Model $model)
    {
        $model->save();

        return $model;
    }

    /**
     * Delete the model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return bool
     */
    public function delete(Model $model)
    {
        return $model->delete();
    }

    /**
     * Get the base database query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     *
     * @throws \Exception
     */
    public function query()
    {
        throw new \Exception('not implemented');
    }
}
