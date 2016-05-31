<?php

namespace App\Repositories\Database;

use App\Foundation\Repositories\DbRepository;
use App\Models\NewsItem;
use App\Repositories\NewsItemRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

class NewsItemDbRepository extends DbRepository implements NewsItemRepository
{
    public function getAll(): Collection
    {
        return $this->query()
            ->orderBy('publish_date', 'desc')
            ->nonDraft()
            ->get();
    }

    public function getLatest(int $amount): Collection
    {
        return $this->query()
            ->orderBy('publish_date', 'desc')
            ->online()
            ->take($amount)
            ->get();
    }

    /**
     * @return \App\Models\NewsItem|null
     */
    public function findNext(NewsItem $newsItem)
    {
        return $this->query()
            ->online()
            ->where('publish_date', '>', $newsItem->publish_date)
            ->orderBy('publish_date', 'desc')
            ->first();
    }

    /**
     * @return \App\Models\NewsItem|null
     */
    public function findPrevious(NewsItem $newsItem)
    {
        return $this->query()
            ->online()
            ->where('publish_date', '<', $newsItem->publish_date)
            ->orderBy('publish_date', 'desc')
            ->first();
    }

    public function paginate(int $perPage): Paginator
    {
        return $this->query()
            ->online()
            ->paginate($perPage);
    }
}
