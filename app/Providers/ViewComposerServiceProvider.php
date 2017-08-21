<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->addComposer('*', \App\Http\ViewComposers\Shared\GlobalViewComposer::class);
        $this->addComposer('*._layouts.*', \App\Http\ViewComposers\Shared\EncryptedCsrfTokenComposer::class);

        $this->addComposer('front._layouts.*', \App\Http\ViewComposers\Front\SeoViewComposer::class);
    }

    protected function addComposer($views, $callback)
    {
        View::composer($views, $callback);
    }
}
