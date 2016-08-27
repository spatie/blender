<?php

namespace App\Repositories;

use App\Foundation\Repositories\Repository;
use app\Models\Article;
use App\Models\Enums\SpecialArticle;
use Illuminate\Support\Collection;

class ArticleRepository extends Repository
{
    const MODEL = Article::class;

    public function query()
    {
        return parent::query()
            ->nonDraft()
            ->orderBy('order_column');
    }

    public function getTopLevel(): Collection
    {
        return $this->query()
            ->whereNull('parent_id')
            ->get();
    }

    public function getSiblings(Article $article): Collection
    {
        return $this->query()
            ->where('parent_id', $article->parent_id)
            ->get();
    }

    public function firstChild(Article $article): Article
    {
        return $this->query()
            ->where('parent_id', $article->id)
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
