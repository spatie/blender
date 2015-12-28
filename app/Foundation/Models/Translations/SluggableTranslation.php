<?php

namespace App\Foundation\Models\Translations;

use App\Foundation\Models\Traits\Sluggable;

class SluggableTranslation extends Translation
{
    use Sluggable;

    protected $guarded = ['id', 'url'];
}
