<?php

namespace app\Models;

use App\Foundation\Models\Base\ModuleModel;
use App\Foundation\Models\Traits\HasSlug;
use Cache;
use Exception;
use Illuminate\Support\Collection;

class Article extends ModuleModel
{
    use HasSlug;

    protected $with = ['media'];

    public $mediaLibraryCollections = ['images', 'downloads'];
    public $translatable = ['name', 'text', 'url'];

    public static function findByTechnicalName(string $technicalName): Article
    {
        return Cache::rememberForever(
            "article.findByTechnicalName.{$technicalName}",
            function () use ($technicalName): Article {
                $article = static::where('technical_name', $technicalName)->first();

                if ($article === null) {
                    throw new Exception("Article `{$technicalName}` not found");
                }

                return $article;
            }
        );
    }

    public static function getWithTechnicalNameLike(string $technicalName): Collection
    {
        return Cache::rememberForever(
            "article.getWithTechnicalNameLike.{$technicalName}",
            function () use ($technicalName): Collection {
                return static::where('technical_name', 'like', "{$technicalName}.%")
                    ->orderBy('order_column')
                    ->get();
            }
        );
    }

    public function isDeletable(): bool
    {
        return !(bool) $this->technical_name;
    }
}
