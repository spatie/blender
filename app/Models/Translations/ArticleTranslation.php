<?php

namespace App\Models\Translations;

use App\Foundation\Models\Translations\SluggableTranslation;

class ArticleTranslation extends SluggableTranslation
{
    protected $sluggable = 'name';
}
