<?php

namespace App\Models\Foundation\Base;

use Cviebrock\EloquentSluggable\SluggableInterface as Sluggable;
use App\Models\Foundation\Traits\Sluggable as SluggableTrait;

class SluggableTranslation extends Translation implements Sluggable
{
    use SluggableTrait;

    protected $guarded = ['id', 'url'];
}
