<?php

namespace App\Foundation\Repositories;

use Illuminate\Contracts\Cache\Repository as Cache;

abstract class CacheRepository extends BaseRepository implements Repository
{
    /**
     * @var \App\Foundation\Repositories\DbRepository
     */
    protected $dbRepository;

    public function getAll()
    {
        return $this->dbRepository->getAll();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id)
    {
        return $this->rememberForever("find.{$id}", function () use ($id) {
            return $this->dbRepository->find($id);
        });
    }

    protected function rememberForever(string $key, $value)
    {
        return app(Cache::class)->rememberForever('repository.'.static::class.'.'.$key, $value);
    }
}
