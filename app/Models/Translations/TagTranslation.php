<?php

namespace App\Models\Translations;

use App\Foundation\Models\Translations\SluggableTranslation;

class TagTranslation extends SluggableTranslation
{
    protected $sluggable = 'name';
}
