<?php

namespace App\Models\Presenters;

use Spatie\String\Str;

trait FragmentPresenter
{
    public function getTeaseAttribute(): Str
    {
        return string($this->text)->tease();
    }
}
