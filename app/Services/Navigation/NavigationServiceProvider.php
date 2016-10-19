<?php

namespace App\Services\Navigation;

use App\Services\Navigation\Menu\BackMenus;
use App\Services\Navigation\Menu\FrontMenus;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class NavigationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerSection();
    }

    public function boot()
    {
        $this->bootMenus();
    }

    protected function registerSection()
    {
        Request::macro('section', function () {
            if (request()->segment(1) === 'blender') {
                return 'back';
            }

            return 'front';
        });

        Request::macro('isFront', function () {
            return request()->section() === 'front';
        });

        Request::macro('isBack', function () {
            return request()->section() === 'back';
        });
    }

    protected function bootMenus()
    {
        $this->app->make(FrontMenus::class)->register();
        $this->app->make(BackMenus::class)->register();
    }
}
