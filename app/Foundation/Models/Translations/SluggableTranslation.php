<?php

namespace App\Foundation\Models\Translations;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class SluggableTranslation extends Translation
{
    use HasSlug;

    protected $guarded = ['id', 'url'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('url')
            ->allowDuplicateSlugs();
    }
}
