<?php

namespace App\Models\Presenters;

trait TagPresenter
{
    public function getAllTagTypesAttribute(): array
    {
        return [
            'newsCategory',
            'newsTag',
        ];
    }
}
