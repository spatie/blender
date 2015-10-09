<?php

namespace App\Models\Presenters;

use App\Models\Foundation\Base\Presenter;

class FragmentPresenter extends Presenter
{
    public function tease()
    {
        return string($this->entity->text)->tease();
    }
}
