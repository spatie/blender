<?php

namespace App\Models\Presenters;

use Laracasts\Presenter\Presenter;
use Spatie\String\Str;

class ArticlePresenter extends Presenter
{
    public function tease($characters, $moreTextIndicator = '...') : Str
    {
        return (string) string($this->entity->text)->tease($characters, $moreTextIndicator);
    }

    public function meta() : Str
    {
        return $this->tease(155);
    }
}
