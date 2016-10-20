<?php

namespace App\Models\Foundation\Base;

use App\Models\Foundation\Traits\Sluggable as SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface as Sluggable;

class SluggableTranslation extends Translation implements Sluggable
{
    use SluggableTrait;

    protected $guarded = ['id', 'url'];
}
