<?php

namespace App\Foundation\Models\Traits;

trait HasSeoValues
{
    /**
     * @param string|null $key
     *
     * @return string|\Illuminate\Support\Collection
     */
    public function seo(string $key = null)
    {
        if (is_null($key)) {
            return collect($this->defaultSeoValues())->merge($this->seo_values ?? []);
        }

        return $this->seo()->get($key);
    }

    public function renderMetaTags(): string
    {
        return $this->seo()->filter(function ($value, $key) {
            return starts_with($key, 'meta_');
        })->map(function ($value, $key) : string {
            $key = substr($key, 5);
            $attribute = starts_with($key, 'og:') ? 'property' : 'name';

            return "<meta {$attribute}=\"{$key}\" content=\"{$value}\">";
        })->implode("\n");
    }
}
