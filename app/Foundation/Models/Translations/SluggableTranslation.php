<?php

namespace App\Foundation\Models\Translations;

use App\Foundation\Models\Traits\HasUrl;

class SluggableTranslation extends Translation
{
    use HasUrl;

    protected $guarded = ['id', 'url'];
}
