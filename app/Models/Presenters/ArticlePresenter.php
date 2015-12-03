<?php

namespace App\Models\Presenters;

use App\Models\Foundation\Base\Presenter;

class ArticlePresenter extends Presenter
{
    /**
     * @param string $characters
     * @param string $moreTextIndicator
     *
     * @return \Spatie\String\Str
     */
    public function tease($characters, $moreTextIndicator = '...')
    {
        return (string) string($this->entity->text)->tease($characters, $moreTextIndicator);
    }

    /**
     * @return string
     */
    public function meta()
    {
        return (string) $this->tease(155);
    }
}
