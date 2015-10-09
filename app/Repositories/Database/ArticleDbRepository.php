<?php

namespace App\Repositories\Database;

use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Database\Eloquent\Collection;

class ArticleDbRepository extends DbRepository implements ArticleRepository
{
    public function __construct()
    {
        $this->model = new Article();
    }

    /**
     * Get all models excluding drafts.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->query()->get();
    }

    /**
     * Get all articles with a technical name like the string given.
     *
     * @param $technicalName
     *
     * @return Collection
     */
    public function getWithTechnicalNameLike($technicalName)
    {
        return $this->model
            ->newQuery()
            ->with(['media', 'translations' => function ($query) {
                $query->where('locale', content_locale());
            }])
            ->where('technical_name', 'like', "{$technicalName}.%")
            ->orderBy('order_column')
            ->get();
    }

    /**
     * Get all online models.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllOnline()
    {
        return $this->query()->online()->get();
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
        return $this->model
            ->newQuery()
            ->with(['media', 'translations'])
            ->find($id);
    }

    /**
     * Find a model by it's url.
     *
     * @param string $url
     * @param string $locale
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByUrl($url, $locale = null)
    {
        $locale = $locale ?: content_locale();

        return $this
            ->query()
            ->online()
            ->whereHas('translations', function ($query) use ($url, $locale) {
                $query
                    ->where('url', $url)
                    ->where('locale', $locale);
            })
            ->first();
    }

    /**
     * Get the article by it's technical name.
     *
     * @param string $technicalName
     *
     * @return \App\Models\Article
     */
    public function findByTechnicalName($technicalName)
    {
        return $this
            ->query()
            ->online()
            ->where('technical_name', $technicalName)
            ->first();
    }

    /**
     * Get the base database query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model
            ->newQuery()
            ->with(['media', 'translations' => function ($query) {
                $query->where('locale', content_locale());
            }])
            ->orderBy('publish_date', 'desc')
            ->nonDraft();
    }
}
