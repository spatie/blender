<?php

namespace App\Providers;

use App\Http\ViewComposers\Back\BlenderFormComposer;
use Illuminate\Support\ServiceProvider;
use View;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function boot()
    {
        View::composer('*', 'App\Http\ViewComposers\GlobalViewComposer');
        View::composer('*.layout.*', 'App\Http\ViewComposers\HtmlAttributesComposer');
        View::composer('*.layout.*', 'App\Http\ViewComposers\EncryptedCsrfTokenComposer');

        View::composer(['back.*.form', 'back.*.*Form'], BlenderFormComposer::class);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
    }
}
