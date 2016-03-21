<?php

namespace App\Models\Presenters;

use Laracasts\Presenter\Presenter;
use Spatie\String\Str;

class NewsItemPresenter extends Presenter
{
    public function excerpt($length = 200) : Str
    {
        return string($this->entity->text)->tease($length);
    }
}
