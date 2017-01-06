<?php

namespace App\Models\Presenters;

use Spatie\String\Str;

trait NewsItemPresenter
{
    public function getExcerptAttribute(): Str
    {
        return string($this->text)->tease(200);
    }
}
