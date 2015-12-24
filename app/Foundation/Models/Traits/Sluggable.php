<?php

namespace App\Foundation\Models\Traits;

use Cviebrock\EloquentSluggable\SluggableTrait;

trait Sluggable
{
    use SluggableTrait {
        makeSlugUnique as makeSlugUniqueParent;
        getSluggableConfig as getSluggableConfigParent;
    }

    protected function makeSlugUnique($slug)
    {
        if (ends_with(get_class($this), 'Translation')) {
            /*
             * if this is a translation class when have to take in account the
             * locale column to determine if the slug is unique
             */
            $slug = $this->makeMultilangualSlugUnique($slug);
        } else {
            /*
             * if this is a regular class use the function of the original trait
             * to determine if the slug is unique
             */
            $slug = $this->makeSlugUniqueParent($slug);
        }

        return $slug;
    }

    protected function makeMultilangualSlugUnique($slug)
    {
        $originalSlug = $slug;
        $instance = new static();
        $i = 1;

        $config = $this->getSluggableConfig();

        while ($instance
            ::where($config['save_to'], '=', $slug)
            ->where('locale', '=', $this->locale)
            ->where('id', '<>', ($this->exists ? $this->id : 0))
            ->first()) {
            $slug = $originalSlug.$config['separator'].$i++;
        };

        return $slug;
    }

    protected function getSluggableConfig()
    {
        $config = app('config')->get('sluggable');

        $config['build_from'] = $this->sluggable;

        return $config;
    }
}
