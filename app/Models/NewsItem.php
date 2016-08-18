<?php

namespace App\Models;

use App\Foundation\Models\Base\ModuleModel;
use App\Foundation\Models\Traits\HasTags;
use App\Foundation\Models\Traits\HasSlug;
use App\Models\Enums\TagType;

class NewsItem extends ModuleModel
{
    use HasSlug, HasTags;

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
