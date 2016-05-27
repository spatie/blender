<?php

namespace App\Models\Presenters;

use Laracasts\Presenter\Presenter;
use Spatie\String\Str;

/**
 * @property \App\Models\NewsItem $entity
 */
class NewsItemPresenter extends Presenter
{
    public function excerpt($length = 200):Str
    {
        return string($this->entity->text)->tease($length);
    }
}
