<?php

namespace App\Models;

use App\Foundation\Models\Base\ModuleModel;
use App\Foundation\Models\Traits\HasUrl;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableInterface;

class Person extends ModuleModel implements SortableInterface
{
    use Sortable, HasUrl;

    protected $with = ['media'];

    public $mediaLibraryCollections = ['images'];
    public $translatable = ['text'];

    public function registerMediaConversions()
    {
        parent::registerMediaConversions();

        $this->addMediaConversion('thumb')
            ->setWidth(368)
            ->setHeight(232)
            ->performOnCollections('images');
    }
}
