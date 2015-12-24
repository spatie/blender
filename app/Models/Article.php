<?php

namespace App\Models;

use App\Models\Foundation\Base\ModuleModel;
use Exception;
use Illuminate\Support\Collection;

class Article extends ModuleModel
{
    protected $with = ['media', 'translations'];

    public $mediaLibraryCollections = ['images', 'downloads'];
    public $translatedAttributes = ['name', 'text', 'url'];

    public static function findByTechnicalName(string $technicalName) : Article
    {
        return app('cache')->rememberForever(
            "article.findByTechnicalName.{$technicalName}",
            function () use ($technicalName) : Article {
                $article = static::where('technical_name', $technicalName)->first();

                if ($article === null) {
                    throw new Exception("Article {$technicalName} not found");
                }

                return $article;
            }
        );
    }

    public static function getWithTechnicalNameLike(string $technicalName) : Collection
    {
        return app('cache')->rememberForever(
            "article.getWithTechnicalNameLike.{$technicalName}",
            function () use ($technicalName) : Collection {
                return static::where('technical_name', 'like', "{$technicalName}.%")
                    ->orderBy('order_column')
                    ->get();
            }
        );
    }

    public function isDeletable() : bool
    {
        return !(bool) $this->technical_name;
    }
}
