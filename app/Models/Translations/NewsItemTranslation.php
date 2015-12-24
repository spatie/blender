<?php

namespace App\Models\Translations;

use App\Foundation\Models\Translations\SluggableTranslation;

class NewsItemTranslation extends SluggableTranslation
{
    protected $sluggable = 'name';
}
