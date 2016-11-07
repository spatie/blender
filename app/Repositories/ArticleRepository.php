<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\Enums\SpecialArticle;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ArticleRepository
{
    public static function getTopLevel(): Collection
    {
        return Article::where('parent_id', null)
            ->orderBy('order_column')
            ->get();
    }

    public static function findBySlug(string $url): Article
    {
        $article =  Article::online()
            ->where('url->'.content_locale(), $url)
            ->first();

        abort_unless($article, 404);

        return $article;
    }

    public static function findSpecialArticle(SpecialArticle $specialArticle): Article
    {
        return Cache::rememberForever(
            "article.specialArticle.{$specialArticle}",
            function () use ($specialArticle) {
                return Article::where('technical_name', $specialArticle)->firstOrFail();
            }
        );
    }
}
