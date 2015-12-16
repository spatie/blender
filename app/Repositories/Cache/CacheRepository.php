<?php

namespace App\Repositories\Cache;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Spatie\OrAbort\OrAbort;

abstract class CacheRepository implements Repository
{
    use OrAbort;

    /**
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * @var \App\Repositories\Database\FragmentDbRepository
     */
    protected $dbRepository;

    /**
     * Fetch all records. (Not cached).
     */
    public function getAll()
    {
        return $this->dbRepository->getAll();
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
        return $this->rememberForever("id.{$id}", function () use ($id) {
            return $this->dbRepository->findById($id);
        });
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

        $this->flush();

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
        $deleted = $model->delete();

        $this->flush();

        return $deleted;
    }

    /**
     * Flush all queries from the cache.
     */
    public function flush()
    {
        $this->cache->flush();
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed
     */
    protected function rememberForever($key, $value)
    {
        return $this->cache->rememberForever('repository.'.static::CACHESECTION.'.'.$key, $value);
    }

    /**
     * @return mixed
     */
    public function query()
    {
        return $this->dbRepository->query();
    }
}
