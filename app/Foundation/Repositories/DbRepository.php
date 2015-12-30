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
    public function findById(int $id)
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

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findByUrl(string $url, string $locale = null)
    {
        /**
         * @todo check if model has translatable attributes,
         * if not --> do not use translations table
         */
        $query = $this
            ->query()
            ->whereHas('translations', function ($query) use ($url, $locale) {
                $query
                    ->where('url', $url)
                    ->where('locale', $locale ?: content_locale());
            });

        return $query->first();
    }


}
