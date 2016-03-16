<?php

namespace App\Providers;

use App\Models\Enums\TagType;
use Illuminate\Support\ServiceProvider;
use Validator;

class ValidationServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        Validator::extend('tags_exist', function ($attribute, $tagNames, $parameters) {
            list($tagType) = $parameters;
            $tagType = new TagType($tagType);

            $exisitingTagNames = app(\App\Repositories\TagRepository::class)
                ->getAllWithType($tagType)
                ->lists('name')
                ->toArray();

            if (!\Spatie\values_in_array($tagNames, $exisitingTagNames)) {
                return false;
            }

            return true;
        });

        Validator::extend('enum', function ($attribute, $value, $parameters) {

            /** @var \App\Foundation\Models\Enums\Enum $class */
            $class = $parameters[0];

            return $class::isValid($value);
        });
    }
}
