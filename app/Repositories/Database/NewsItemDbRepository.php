<?php

namespace App\Repositories\Database;

use App\Models\NewsItem;
use App\Repositories\NewsItemRepository;

class NewsItemDbRepository extends DbRepository implements NewsItemRepository
{
    public function __construct()
    {
        $this->model = new NewsItem();
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
     * Get the latest X models.
     *
     * @param int $amount
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLatest($amount = 10)
    {
        return $this->query()->online()->take($amount)->get();
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
     * Find a model by it's url.
     *
     * @param string $url
     * @param string $locale
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByUrl($url, $locale = null)
    {
        $query = $this
            ->query()
            ->online()
            ->whereHas('translations', function ($query) use ($url, $locale) {
                $query
                    ->where('url', $url)
                    ->where('locale', $locale ?: content_locale());
            })
        ;

        return $query->first();
    }

    /**
     * Find the next news item based on publish_date.
     *
     * @param \App\Models\NewsItem $newsItem
     *
     * @return \App\Models\NewsItem
     */
    public function findNext(NewsItem $newsItem)
    {
        return $this->model->newQuery()
            ->online()
            ->where('publish_date', '>', $newsItem->publish_date)
            ->orderBy('publish_date', 'asc')
            ->first();
    }

    /**
     * Find the previous news item based on publish_date.
     *
     * @param \App\Models\NewsItem $newsItem
     *
     * @return \App\Models\NewsItem
     */
    public function findPrevious(NewsItem $newsItem)
    {
        return $this->model->newQuery()
            ->online()
            ->where('publish_date', '<', $newsItem->publish_date)
            ->orderBy('publish_date', 'desc')
            ->first();
    }

    /**
     * Get the models for a page.
     *
     * @param int $perPage
     *
     * @return \Illuminate\Pagination\Paginator
     */
    public function paginate($perPage = 10)
    {
        return $this->query()->online()->simplePaginate($perPage);
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
