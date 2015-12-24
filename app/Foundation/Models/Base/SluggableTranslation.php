<?php

namespace App\Models\Foundation\Base;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class SluggableTranslation extends Translation
{
    use HasSlug;

    protected $guarded = ['id', 'url'];

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
