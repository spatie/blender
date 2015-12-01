<?php

namespace App\Repositories\Database;

use App\Models\Tag;
use App\Models\Foundation\Traits\HasTags;
use App\Repositories\TagRepository;

class TagDbRepository extends DbRepository implements TagRepository
{
    public function __construct()
    {
        $this->model = new Tag();
    }

    /**
     * Get all models excluding drafts.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model
            ->newQuery()
            ->with(['translations' => function ($query) {
                $query->where('locale', content_locale());
            }])
            ->nonDraft()
            ->orderBy('order_column')
            ->get();
    }

    /**
     * Get all tags that are online.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllOnline()
    {
        $query = $this->model->newQuery();

        return $query
            ->online()
            ->orderBy('order_column')
            ->get();
    }

    /**
     * Get all tags that are online.
     *
     * @param string $type
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllWithType($type)
    {
        return $this->model->newQuery()
            ->where('type', $type)
            ->online()
            ->orderBy('order_column')
            ->get();
    }

    /**
     * Find a tag by name, type and locale.
     *
     * @param string $name
     * @param string $type
     * @param string $locale
     *
     * @return \App\Models\Tag
     */
    public function findByName($name, $type = null, $locale = null)
    {
        $type = $type ?: HasTags::getDefaultTagType();
        $locale = $locale ?: HasTags::getDefaultTagLocale();

        return $this->model
            ->where('type', $type)
            ->whereHas('translations', function ($q) use ($name, $locale) {
                $q
                    ->where('name', $name)
                    ->where('locale', $locale);
            })
            ->first();
    }

    /**
     * Find a tag by name or create (and save) it.
     *
     * @param string $name
     * @param string $type
     * @param string $locale
     *
     * @return \App\Models\Tag
     */
    public function findByNameOrCreate($name, $type = null, $locale = null)
    {
        $tag = $this->findByName($name, $type, $locale);

        if ($tag === null) {
            $tag = $this->model->createFromName($name, $type);
        }

        return $tag;
    }

    /**
     * Get a tag from it's url.
     *
     * @param string $url
     * @param string $locale
     *
     * @return \App\Models\Tag
     */
    public function findByUrl($url, $type = null, $locale = null)
    {
        $type = $type ?: HasTags::getDefaultTagType();
        $locale = $locale ?: content_locale();

        return $this->model
            ->where('type', $type)
            ->whereHas('translations', function ($query) use ($url, $locale) {
                $query
                    ->where('url', $url)
                    ->where('locale', $locale);
            })
            ->first();
    }
}
