<?php

namespace App\Models\Presenters;

trait ArticlePresenter
{
    public function getExcerptAttribute(): string
    {
        return str_tease($this->text, 200);
    }

    public function getMetaAttribute(): string
    {
        return str_tease($this->text, 155);
    }
}
