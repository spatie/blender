<?php

namespace App\Foundation\Models\Traits;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

trait Sluggable
{
    use HasSlug;

    public function getSlugOptions() : SlugOptions {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('url')
            ->allowDuplicateSlugs();
    }
}
