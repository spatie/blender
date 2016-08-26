<?php

namespace App\Models\Presenters;

use Spatie\String\Str;

trait ArticlePresenter
{
    public function getTeaseAttribute($characters, $moreTextIndicator = '...'): Str
    {
        return string($this->text)->tease($characters, $moreTextIndicator);
    }

    public function getMetaAttribute(): Str
    {
        return $this->tease(155);
    }
}
