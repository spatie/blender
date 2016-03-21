<?php

namespace App\Models\Presenters;

use Laracasts\Presenter\Presenter;
use Spatie\String\Str;

/**
 * @property \App\Models\Fragment $entity
 */
class FragmentPresenter extends Presenter
{
    public function tease() : Str
    {
        return string($this->entity->text)->tease();
    }
}
