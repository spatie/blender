<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function boot()
    {
        $this->addComposer('*', \App\Http\ViewComposers\Shared\GlobalViewComposer::class);
        $this->addComposer('*.layout.*', \App\Http\ViewComposers\Shared\EncryptedCsrfTokenComposer::class);

        $this->addComposer('front.layout.*', \App\Http\ViewComposers\Front\SeoViewComposer::class);

        $this->addComposer(['back.*.form', 'back.*.*Form'], \App\Http\ViewComposers\Back\BlenderFormComposer::class);
    }

    /**
     * @param array|string    $views
     * @param \Closure|string $callback
     */
    protected function addComposer($views, $callback)
    {
        app('view')->composer($views, $callback);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
    }
}
