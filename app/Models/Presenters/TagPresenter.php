<?php

namespace App\Models\Presenters;

use App\Models\Enums\TagType;
use Laracasts\Presenter\Presenter;

/**
 * @property \App\Models\Tag $entity
 */
class TagPresenter extends Presenter
{
    public function allTagTypes(): array
    {
        $tagTypes = [];

        foreach (TagType::values() as $value) {
            $tagTypes[(string) $value] = fragment("back.tags.types.{$value}");
        }

        return collect($tagTypes)->sort()->toArray();
    }
}
