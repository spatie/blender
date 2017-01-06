<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Spatie\Blender\Model\Model;
use Spatie\Blender\Model\Traits\HasSlug;
use App\Models\Presenters\NewsItemPresenter;

class NewsItem extends Model
{
    use HasSlug, HasTags, NewsItemPresenter;

    protected $with = ['media', 'tags'];
    protected $dates = ['publish_date'];

    public $tagTypes = ['newsCategory', 'newsTag'];
    public $mediaLibraryCollections = ['images', 'downloads'];
    public $translatable = ['name', 'text', 'slug', 'seo_values'];

    public function registerMediaConversions()
    {
        parent::registerMediaConversions();

        $this->addMediaConversion('thumb')
            ->setWidth(368)
            ->setHeight(232)
            ->performOnCollections('images');
    }
}
