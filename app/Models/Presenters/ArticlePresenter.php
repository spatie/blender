<?php

namespace App\Models\Presenters;

use Laracasts\Presenter\Presenter;
use Spatie\String\Str;

/**
 * @property \App\Models\Article $entity
 */
class ArticlePresenter extends Presenter
{
    public function tease($characters, $moreTextIndicator = '...'): Str
    {
        return string($this->entity->text)->tease($characters, $moreTextIndicator);
    }

    public function meta(): Str
    {
        return $this->tease(155);
    }
}
