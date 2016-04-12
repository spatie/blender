<?php

namespace App\Foundation\Models\Translations;

use App\Foundation\Models\Traits\HasSlug;

class SluggableTranslation extends Translation
{
    use HasSlug;

    protected $guarded = ['id', 'url'];
}
