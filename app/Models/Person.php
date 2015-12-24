<?php

namespace App\Models;

use App\Foundation\Models\Base\ModuleModel;
use App\Foundation\Models\Traits\Sluggable as SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface as Sluggable;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableInterface;

class Person extends ModuleModel implements Sluggable, SortableInterface
{
    use SluggableTrait, Sortable;

    protected $sluggable = 'name';

    public $mediaLibraryCollections = ['images'];
    public $translatedAttributes = ['function', 'career'];

    public function registerMediaConversions()
    {
        parent::registerMediaConversions();

        $this->addMediaConversion('thumb')
            ->setWidth(368)
            ->setHeight(232)
            ->performOnCollections('images');
    }
}
