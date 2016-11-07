<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

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
