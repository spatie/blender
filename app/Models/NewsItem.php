<?php

namespace App\Models;

use App\Foundation\Models\Base\ModuleModel;
use App\Models\Enums\TagType;
use App\Foundation\Models\Traits\HasTags;
use App\Foundation\Models\Interfaces\HasTags as HasTagsInterface;

class NewsItem extends ModuleModel implements HasTagsInterface
{
    use HasTags;

    protected $moduleName = 'newsItems';
    protected $dates = ['publish_date'];

    public $tagTypes = [TagType::NEWS_ITEM_TAG, TagType::NEWS_ITEM_CATEGORY];
    public $mediaLibraryCollections = ['images', 'downloads'];
    public $translatedAttributes = ['name', 'text', 'url'];

    public function registerMediaConversions()
    {
        parent::registerMediaConversions();

        $this->addMediaConversion('thumb')
            ->setWidth(368)
            ->setHeight(232)
            ->performOnCollections('images');
    }
}
