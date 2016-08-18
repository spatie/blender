<?php

namespace App\HasMeta;

use Illuminate\Support\Collection;

class MetaValueCollection extends Collection
{
    public function render(): string
    {
        return $this->map(function ($value, $key): string {
            $attribute = starts_with($key, 'og:') ? 'property' : 'name';
            return "<meta {$attribute}=\"{$key}\" content=\"{$value}\">";
        })->implode("\n");
    }

    public function toBase(): Collection
    {
        return new Collection($this->items);
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
