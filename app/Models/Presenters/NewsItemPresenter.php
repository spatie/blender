<?php

namespace App\Models\Presenters;

use Spatie\String\Str;

trait NewsItemPresenter
{
    public function getExcerptAttribute($length = 200): Str
    {
        return string($this->text)->tease($length);
    }
}
