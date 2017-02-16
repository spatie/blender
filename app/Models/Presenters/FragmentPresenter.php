<?php

namespace App\Models\Presenters;

trait FragmentPresenter
{
    public function getExcerptAttribute(): string
    {
        return str_limit($this->getTranslation(content_locale()), 200);
    }

    public function getFullNameAttribute(): string
    {
        return $this->group.'.'.$this->key;
    }
}
