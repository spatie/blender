<?php

namespace App\Models\Presenters;

use Laracasts\Presenter\Presenter;
use Spatie\String\Str;

class FragmentPresenter extends Presenter
{
    public function tease() : Str
    {
        return string($this->entity->text)->tease();
    }
}
