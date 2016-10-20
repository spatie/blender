<?php

namespace App\Repositories;

use App\Models\NewsItem;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

class NewsItemRepository
{
    public static function getLatest(int $amount): Collection
    {
        return NewsItem::online()
            ->orderBy('publish_date', 'desc')
            ->take($amount)
            ->get();
    }

    public static function findByUrl(string $url): NewsItem
    {
        return NewsItem::online()
            ->where('url->'.content_locale(), $url)
            ->firstOrFail();
    }

    /**
     * @return \App\Models\NewsItem|null
     */
    public static function findNext(NewsItem $newsItem)
    {
        return NewsItem::online()
            ->where('publish_date', '>', $newsItem->publish_date)
            ->orderBy('publish_date', 'desc')
            ->first();
    }

    /**
     * @return \App\Models\NewsItem|null
     */
    public static function findPrevious(NewsItem $newsItem)
    {
        return NewsItem::online()
            ->where('publish_date', '<', $newsItem->publish_date)
            ->orderBy('publish_date', 'desc')
            ->first();
    }

    public static function paginate(int $perPage): Paginator
    {
        return NewsItem::online()->paginate($perPage);
    }
}
