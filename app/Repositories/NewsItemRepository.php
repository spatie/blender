<?php

namespace App\Repositories;

use App\Foundation\Repositories\Repository;
use App\Models\NewsItem;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

interface NewsItemRepository extends Repository
{
    const MODEL = NewsItem::class;

    /**
     * @return \App\Models\NewsItem|null
     */
    public function findNext(NewsItem $newsItem);

    /**
     * @return \App\Models\NewsItem|null
     */
    public function findPrevious(NewsItem $newsItem);

    public function paginate(int $perPage):Paginator;

    public function getLatest(int $amount):Collection;
}
