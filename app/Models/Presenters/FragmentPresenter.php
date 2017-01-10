<?php

namespace App\Models\Presenters;

use Spatie\String\Str;

trait FragmentPresenter
{
    public function getExcerptAttribute(): Str
    {
        return string($this->text)->tease(200);
    }

    public function getFullNameAttribute(): string
    {
        return $this->group.'.'.$this->key;
    }
}
