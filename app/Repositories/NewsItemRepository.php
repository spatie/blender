<?php

namespace App\Repositories;

use App\Models\NewsItem;

interface NewsItemRepository extends Repository
{
    /**
     * Get all online models.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllOnline();

    /**
     * Find a model by it's url.
     *
     * @param string $url
     * @param string $locale
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByUrl($url, $locale = null);

    /**
     * Find the next news item based on publish_date.
     *
     * @param \App\Models\NewsItem $newsItem
     *
     * @return \App\Models\NewsItem
     */
    public function findNext(NewsItem $newsItem);

    /**
     * Find the previous news item based on publish_date.
     *
     * @param \App\Models\NewsItem $newsItem
     *
     * @return \App\Models\NewsItem
     */
    public function findPrevious(NewsItem $newsItem);

    /**
     * Get the models for a page.
     *
     * @param int $perPage
     *
     * @return \Illuminate\Pagination\Paginator
     */
    public function paginate($perPage = 10);

    /**
     * Get the latest X models.
     *
     * @param int $amount
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLatest($amount = 10);
}
