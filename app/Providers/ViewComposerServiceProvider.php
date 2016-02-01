<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function register()
    {
    }
    
    public function boot()
    {
        $this->addComposer('*', \App\Http\ViewComposers\Shared\GlobalViewComposer::class);
        $this->addComposer('*.layout.*', \App\Http\ViewComposers\Shared\EncryptedCsrfTokenComposer::class);

        $this->addComposer('front.layout.*', \App\Http\ViewComposers\Front\SeoViewComposer::class);

        $this->addComposer(['back.*.form', 'back.*.*Form'], \App\Http\ViewComposers\Back\BlenderFormComposer::class);
    }

    protected function addComposer($views, $callback)
    {
        app('view')->composer($views, $callback);
    }
}
