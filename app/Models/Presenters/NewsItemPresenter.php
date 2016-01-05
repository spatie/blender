<?php

namespace App\Models\Presenters;

use Laracasts\Presenter\Presenter;

class NewsItemPresenter extends Presenter
{
    /**
     *  Get an array with all possible types.
     *
     * @param int $length
     *
     * @return \Spatie\String\Str
     */
    public function excerpt($length = 200)
    {
        return string($this->entity->text)->tease($length);
    }
}
