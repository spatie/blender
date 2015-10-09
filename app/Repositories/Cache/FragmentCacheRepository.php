<?php

namespace App\Repositories\Cache;

use App\Repositories\FragmentRepository;
use App\Repositories\Database\FragmentDbRepository;
use Illuminate\Contracts\Cache\Repository as Cache;

class FragmentCacheRepository extends CacheRepository implements FragmentRepository
{
    const CACHESECTION = 'fragmentRepository';

    /**
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * @param \Illuminate\Contracts\Cache\Repository $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
        $this->dbRepository = new FragmentDbRepository();
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
        return $this->rememberForever("name.{$name}", function () use ($name) {
            return $this->dbRepository->findByName($name);
        });
    }
}
