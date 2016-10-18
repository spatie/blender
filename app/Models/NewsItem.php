<?php

namespace App\Models;

use App\Models\Enums\TagType;
use App\Models\Presenters\NewsItemPresenter;
use Spatie\Blender\Model\Model;
use Spatie\Blender\Model\Traits\HasSlug;
use Spatie\Blender\Model\Traits\HasTags;

class NewsItem extends Model
{
    use HasSlug, HasTags, NewsItemPresenter;

    protected $with = ['media', 'tags'];
    protected $dates = ['publish_date'];

    public $tagTypes = [TagType::NEWS_CATEGORY, TagType::NEWS_TAG];
    public $mediaLibraryCollections = ['images', 'downloads'];
    public $translatable = ['name', 'text', 'url', 'seo_values'];

    public function registerMediaConversions()
    {
        parent::registerMediaConversions();

        $this->addMediaConversion('thumb')
            ->setWidth(368)
            ->setHeight(232)
            ->performOnCollections('images');
    }
}
