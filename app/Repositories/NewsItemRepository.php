<?php

namespace App\Repositories;

use App\Models\NewsItem;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\Paginator;

class NewsItemRepository
{
    public static function getAll(): Collection
    {
        return NewsItem::orderBy('publish_date', 'desc')->get();
    }

    public static function getLatest(int $amount): Collection
    {
        return NewsItem::orderBy('publish_date', 'desc')
            ->take($amount)
            ->get();
    }

    public static function findById(int $id): NewsItem
    {
        return NewsItem::findOrFail($id);
    }

    public static function findBySlug(string $slug): NewsItem
    {
        return NewsItem::where('slug->'.content_locale(), $slug)->firstOrFail();
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
