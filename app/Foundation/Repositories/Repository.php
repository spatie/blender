<?php

namespace App\Foundation\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class Repository
{
    public function save(Model $model): bool
    {
        $saved = $model->save();

        if ($saved) {
            app('cache')->flush();
        }

        return $saved;
    }

    public function delete(Model $model): bool
    {
        $deleted = $model->delete();

        if ($deleted) {
            app('cache')->flush();
        }

        return $deleted;
    }

    public function getAll(): Collection
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

    public function getAllOnline(): Collection
    {
        return $this->query()
            ->online()
            ->get();
    }

    /**
     * @param string $url
     * @param array  $with
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findByUrl(string $url, $with = [])
    {
        $model = static::MODEL;

        $locale = content_locale();

        if (!isset((new $model())->translatedAttributes)) {
            return $this->query()
                ->online()
                ->where('url', 'regexp', "\"{$locale}\"\s*:\s*\"{$url}\"")
                ->first();
        }

        return $this->query()
            ->with($with)
            ->online()
            ->whereTranslation('url', $url, $locale)
            ->first();
    }

    protected function query()
    {
        return call_user_func(static::MODEL.'::query');
    }
}
