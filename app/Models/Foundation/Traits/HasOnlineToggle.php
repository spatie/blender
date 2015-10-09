<?php

namespace App\Models\Foundation\Traits;

trait HasOnlineToggle
{
    /**
     * @param array $attributes
     */
    protected function updateOnlineToggle($attributes)
    {
        $this->online = isset($attributes['online']) ? $attributes['online'] : false;
    }
}
