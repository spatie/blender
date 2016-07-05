<?php

namespace App\Foundation\Repositories;

trait CachesResults
{
    protected function rememberForever(string $key, $value)
    {
        return cache()->rememberForever('repository.' . static::class . '.' . $key, $value);
    }
}
