<?php

namespace App\Models\Presenters;

trait NewsItemPresenter
{
    public function getExcerptAttribute(): string
    {
        return str_tease($this->text);
    }
}
