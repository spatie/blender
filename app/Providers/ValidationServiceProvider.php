<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('enum', function ($attribute, $value, $parameters) {

            /** @var \App\Foundation\Enums\Enum $class */
            $class = $parameters[0];

            return $class::isValid($value);
        });
    }
}
