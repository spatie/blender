<?php

namespace App\Models\Presenters;

use App\Models\Enums\TagType;
use Laracasts\Presenter\Presenter;

class TagPresenter extends Presenter
{
    /**
     *  Get an array with all possible types.
     */
    public function allTagTypes()
    {
        $tagTypes = [];

        foreach (TagType::values() as $value) {
            $tagTypes[(string) $value] = fragment("back.tags.types.{$value}");
        }

        return collect($tagTypes)->sort();
    }
}
