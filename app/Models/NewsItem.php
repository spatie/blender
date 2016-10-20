<?php

namespace App\Models;

use App\Models\Enums\TagType;
use App\Models\Foundation\Base\ModuleModel;
use App\Models\Foundation\Interfaces\HasTags as HasTagsInterface;
use App\Models\Foundation\Traits\HasOnlineToggle;
use App\Models\Foundation\Traits\HasTags;
use Carbon\Carbon;

class NewsItem extends ModuleModel implements HasTagsInterface
{
    use HasOnlineToggle, HasTags;

    protected $moduleName = 'newsItems';
    protected $dates = ['publish_date'];
    protected $mediaLibraryCollections = ['images', 'downloads'];
    protected $tagTypes = [TagType::NEWS_ITEM_TAG, TagType::NEWS_ITEM_CATEGORY];
    public $translatedAttributes = ['name', 'text', 'url'];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setWidth(368)
            ->setHeight(232)
            ->performOnCollections('images');
    }

    /**
     * @param array $attributes
     *
     * @return $this
     */
    public function updateWithRelations(array $attributes)
    {
        parent::updateWithRelations($attributes);

        $this->publish_date = Carbon::createFromFormat('d/m/Y', $attributes['publish_date']);

        return $this;
    }
}
