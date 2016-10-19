<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\Enums\SpecialArticle;
use Illuminate\Support\Collection;

class ArticleRepository
{
    public function getTopLevel(): Collection
    {
        return Article::all()
            ->whereNull('parent_id')
            ->orderBy('order_column')
            ->get();
    }

    public function getSiblings(Article $article): Collection
    {
        return Article::all()
            ->where('parent_id', $article->parent_id)
            ->orderBy('order_column')
            ->get();
    }

    public function firstChild(Article $article): Article
    {
        return Article::all()
            ->where('parent_id', $article->id)
            ->orderBy('order_column')
            ->first();
    }

    /**
     * @param \App\Models\Enums\SpecialArticle $specialArticle
     *
     * @return \App\Models\Article|null
     */
    public function findSpecialArticle(SpecialArticle $specialArticle)
    {
        return $this->query()->where('technical_name', $specialArticle)->first();
    }
}
