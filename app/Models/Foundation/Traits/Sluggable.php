<?php

namespace App\Models\Foundation\Traits;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

trait Sluggable
{
    use HasSlug;

    public function getSlugOptions() : SlugOptions {

        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('url');
    }
}
