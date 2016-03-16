<?php

namespace App\Foundation\Repositories;

use Illuminate\Support\Collection;

abstract class DbRepository extends BaseRepository implements Repository
{
    public function getAll() : Collection
    {
        return $this->query()->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id)
    {
        return $this->query()->find($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findOnline(int $id)
    {
        return $this->query()->online()->find($id);
    }

    public function getAllOnline() : Collection
    {
        return $this->query()
            ->online()
            ->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findByUrl(string $url)
    {
        $model = static::MODEL;

        if (! isset((new $model)->translatedAttributes)) {
            return $this->query()->online()->where('url', $url)->first();
        }

        return $this->query()
            ->online()
            ->whereTranslation('url', $url, content_locale())
            ->first();
    }


}
