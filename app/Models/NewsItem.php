<?php

namespace App\Models;

use App\Models\Presenters\NewsItemPresenter;
use Spatie\Blender\Model\Model;
use Spatie\Blender\Model\Traits\HasSlug;
use Spatie\Tags\HasTags;

class NewsItem extends Model
{
    use HasSlug, HasTags, NewsItemPresenter;

    protected $with = ['media', 'tags'];
    protected $dates = ['publish_date'];

    public $tagTypes = ['newsCategory', 'newsTag'];
    public $translatable = ['name', 'text', 'slug', 'seo_values'];

    protected $mediaLibraryCollections = [
        'images' => 'images',
        'downloads' => 'downloads',
    ];

    public function registerMediaConversions()
    {
        parent::registerMediaConversions();

        $this->addMediaConversion('thumb')
            ->setWidth(368)
            ->setHeight(232)
            ->performOnCollections('images');
    }
}
