<?php

namespace App\Models;

use App\Models\Foundation\Base\ModuleModel;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableInterface;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Person extends ModuleModel implements SortableInterface
{
    use Sortable, HasSlug;

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

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('url')
            ->allowDuplicateSlugs();
    }
}
