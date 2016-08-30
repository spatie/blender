<?php

namespace App\Models\Presenters;

use App\Models\Enums\TagType;

trait TagPresenter
{
    public function getAllTagTypesAttribute(): array
    {
        $tagTypes = [];

        foreach (TagType::values() as $value) {
            $tagTypes[(string) $value] = fragment("back.tags.types.{$value}");
        }

        return collect($tagTypes)->sort()->toArray();
    }
}
