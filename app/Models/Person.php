<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\Models\Media;

class Person extends Model implements Sortable
{
    use HasSlug, SortableTrait;

    protected $with = ['media'];

    public $translatable = ['text'];

    protected $mediaLibraryCollections = ['images'];

    public function registerMediaConversions(Media $media = null)
    {
        parent::registerMediaConversions();

        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->optimize()
            ->performOnCollections('images');
    }

    protected function generateSlug(): string
    {
        return str_slug($this->name);
    }
}
