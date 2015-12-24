<?php

namespace App\Foundation\Models\Translations;

use Cviebrock\EloquentSluggable\SluggableInterface as Sluggable;
use App\Foundation\Models\Traits\Sluggable as SluggableTrait;

class SluggableTranslation extends Translation implements Sluggable
{
    use SluggableTrait;

    protected $guarded = ['id', 'url'];
}
