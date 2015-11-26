<?php

namespace App\Models;

use App\Models\Foundation\Base\ModuleModel;
use App\Models\Foundation\Traits\HasOnlineToggle;
use App\Models\Foundation\Traits\Sluggable as SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface as Sluggable;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableInterface;

class Person extends ModuleModel implements Sluggable, SortableInterface
{
    use HasOnlineToggle, SluggableTrait, Sortable;

    protected $sluggable = 'name';
    protected $mediaLibraryCollections = ['images'];

    public $translatedAttributes = ['function', 'career'];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setWidth(368)
            ->setHeight(232)
            ->performOnCollections('images');
            
        parent::registerMediaConversions();
    }

    /**
     * @param array $attributes
     *
     * @return $this
     */
    public function updateWithRelations(array $attributes)
    {
        parent::updateWithRelations($attributes);

        $this->name = $attributes['name'];

        return $this;
    }
}
