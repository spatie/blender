<?php

namespace App\Models;

use App\Foundation\Models\Base\ModuleModel;
use App\Foundation\Models\Traits\Sluggable;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableInterface;

class Person extends ModuleModel implements SortableInterface
{
    use Sortable, Sluggable;

    protected $with = ['translations', 'media'];

    public $mediaLibraryCollections = ['images'];
    public $translatedAttributes = ['text'];

    public function registerMediaConversions()
    {
        parent::registerMediaConversions();

        $this->addMediaConversion('thumb')
            ->setWidth(368)
            ->setHeight(232)
            ->performOnCollections('images');
    }
}
