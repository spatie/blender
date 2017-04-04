<?php

namespace App\Models\Traits;

use Illuminate\Support\HtmlString;

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
            return collect($this->defaultSeoValues())
                ->merge(collect($this->seo_values ?? [])->filter());
        }

        return $this->seo()->get($key);
    }

    public function renderSeoTags()
    {
        $html = $this->seo()->filter(function ($value, $key) {
            return starts_with($key, 'meta_');
        })->map(function ($value, $key) : string {
            $key = substr($key, 5);
            $attribute = starts_with($key, 'og:') ? 'property' : 'name';

            return "<meta {$attribute}=\"{$key}\" content=\"{$value}\">";
        })->implode("\n");

        return new HtmlString($html);
    }
}
