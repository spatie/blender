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

    public static function findByUrl(string $url): Article
    {
        return Article::online()
            ->where('url->'.content_locale(), $url)
            ->firstOrFail();
    }

    public static function findSpecialArticle(SpecialArticle $specialArticle): Article
    {
        return Article::where('technical_name', $specialArticle)->firstOrFail();
    }

    public static function findByTechnicalName(string $technicalName): Article
    {
        return Cache::rememberForever(
            "article.findByTechnicalName.{$technicalName}",
            function () use ($technicalName) {
                return Article::where('technical_name', $technicalName)->firstOrFail();
            }
        );
    }

    public static function getWithTechnicalNameLike(string $technicalName): Collection
    {
        return Cache::rememberForever(
            "article.getWithTechnicalNameLike.{$technicalName}",
            function () use ($technicalName) {
                return Article::where('technical_name', 'like', "{$technicalName}.%")
                    ->orderBy('order_column')
                    ->get();
            }
        );
    }
}
