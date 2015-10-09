<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Validator::extend('tags_exist', function ($attributeName, $tagNames, $parameters) {
            list($tagType) = $parameters;

            $exisitingTagNames = app(\App\Repositories\TagRepository::class)
                ->getAllWithType($tagType)
                ->lists('name')
                ->toArray();

            if (!\Spatie\values_in_array($tagNames, $exisitingTagNames)) {
                return false;
            }

            return true;
        });
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }
}
