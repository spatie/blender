<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Blender\Model\Traits\Draftable;
use Spatie\Blender\Model\Traits\HasMedia;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class ContentBlock extends Model
{
    use Draftable, SortableTrait, HasTranslations, HasMedia;

    public $mediaLibraryCollections = ['images', 'downloads'];

    public $translatable = ['name', 'text'];

    public function registerMediaConversions()
    {
        parent::registerMediaConversions();

        $this->addMediaConversion('thumb')
            ->setWidth(368)
            ->setHeight(232)
            ->performOnCollections('images');
    }
}
