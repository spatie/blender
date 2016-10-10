<?php

namespace App\Models\Presenters;

use Spatie\String\Str;

trait FragmentPresenter
{
    public function getTeaseAttribute(): Str
    {
        return string($this->getTranslation(app()->getLocale()))->tease();
    }

    public function getFullNameAttribute(): string
    {
        return $this->group.'.'.$this->key;
    }
}
