<?php

namespace App\Models\Presenters;

use Spatie\String\Str;

trait ArticlePresenter
{
    public function getExcerptAttribute(): Str
    {
        return string($this->text)->tease(200);
    }

    public function getMetaAttribute(): Str
    {
        return $this->tease(155);
    }
}
