<?php

namespace App\Models\Translations;

use App\Models\Foundation\Base\SluggableTranslation;

class TagTranslation extends SluggableTranslation
{
    protected $sluggable = 'name';
}
