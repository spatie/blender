<?php

namespace App\Models\Presenters;

use Laracasts\Presenter\Presenter;

class FragmentPresenter extends Presenter
{
    public function tease()
    {
        return string($this->entity->text)->tease();
    }
}
