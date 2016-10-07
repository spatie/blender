<?php

namespace App\Models\Presenters;

use Spatie\String\Str;

trait LanguageLinePresenter
{
    public function getTeaseAttribute(): Str
    {
        return string($this->text)->tease();
    }
}
