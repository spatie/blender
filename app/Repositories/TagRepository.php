<?php

namespace App\Repositories;

interface TagRepository extends Repository
{
    /**
     * Get all tags that are online.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllOnline();

    /**
     * Get all tags that are online.
     *
     * @param string $type
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllWithType($type);

    /**
     * Find a tag by name, type and locale.
     *
     * @param string $name
     * @param string $type
     * @param string $locale
     *
     * @return \App\Models\Tag
     */
    public function findByName($name, $type = null, $locale = null);

    /**
     * Find a tag by name or create (and save) it.
     *
     * @param string $name
     * @param string $type
     * @param string $locale
     *
     * @return \App\Models\Tag
     */
    public function findByNameOrCreate($name, $type = null, $locale = null);

    /**
     * Get a tag from it's url.
     *
     * @param string $url
     *
     * @return \App\Models\Tag
     */
    public function findByUrl($url, $type = null, $locale = null);

    /**
     * Set the new order.
     *
     * @param array $ids
     *
     * @throws \Spatie\EloquentSortable\SortableException
     */
    public function setNewOrder($ids);
}
