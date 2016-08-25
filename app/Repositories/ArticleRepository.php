<?php

namespace App\Repositories;

use App\Foundation\Repositories\Repository;
use App\Models\Article;
use App\Models\Enums\SpecialArticle;
use Illuminate\Support\Collection;

interface ArticleRepository extends Repository
{
    const MODEL = Article::class;

    public function getTopLevel(): Collection;

    public function getSiblings(Article $article): Collection;

    public function firstChild(Article $article): Article;

    public function findSpecialArticle(SpecialArticle $specialArticle);
}
