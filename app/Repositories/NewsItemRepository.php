<?php

namespace App\Repositories;

use App\Models\NewsItem;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;
use Spatie\Blender\Model\Repository;

class NewsItemRepository extends Repository
{
    public function getAll(): Collection
    {
        return NewsItem::orderBy('publish_date', 'desc')->get();
    }

    public function getAllOnline(): Collection
    {
        return NewsItem::online()
            ->orderBy('publish_date', 'desc')
            ->get();
    }

    public function getLatest(int $amount): Collection
    {
        return NewsItem::online()
            ->orderBy('publish_date', 'desc')
            ->take($amount)
            ->get();
    }

    public function findOnline(int $id): NewsItem
    {
        return NewsItem::online()->findOrFail($id);
    }

    public function findByUrl(string $url): NewsItem
    {
        return NewsItem::online()
            ->where('url->'.content_locale(), $url)
            ->firstOrFail();
    }

    /**
     * @return \App\Models\NewsItem|null
     */
    public function findNext(NewsItem $newsItem)
    {
        return NewsItem::online()
            ->where('publish_date', '>', $newsItem->publish_date)
            ->orderBy('publish_date', 'desc')
            ->first();
    }

    /**
     * @return \App\Models\NewsItem|null
     */
    public function findPrevious(NewsItem $newsItem)
    {
        return NewsItem::online()
            ->where('publish_date', '<', $newsItem->publish_date)
            ->orderBy('publish_date', 'desc')
            ->first();
    }

    public function paginate(int $perPage): Paginator
    {
        return NewsItem::online()->paginate($perPage);
    }
}
