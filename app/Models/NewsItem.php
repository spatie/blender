<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use App\Models\Traits\HasSlug;
use App\Models\Presenters\NewsItemPresenter;

class NewsItem extends Model
{
    use HasSlug, HasTags, NewsItemPresenter;

    protected $with = ['media', 'tags'];
    protected $dates = ['publish_date'];

    public $tagTypes = ['newsCategory', 'newsTag'];
    public $translatable = ['name', 'text', 'slug', 'seo_values'];

    protected $mediaLibraryCollections = ['images', 'downloads'];

    public function registerMediaConversions()
    {
        parent::registerMediaConversions();

        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->performOnCollections('images');
    }
}
