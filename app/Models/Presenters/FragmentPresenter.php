<?php

namespace App\Models\Presenters;

trait FragmentPresenter
{
    public function getExcerptAttribute(): string
    {
        return str_tease($this->getTranslation(content_locale()), 200);
    }

    public function getFullNameAttribute(): string
    {
        return $this->group.'.'.$this->key;
    }
}
