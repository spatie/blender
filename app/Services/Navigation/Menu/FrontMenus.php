<?php

namespace App\Services\Navigation\Menu;

use Spatie\Menu\Laravel\Menu;

class FrontMenus
{
    public function register()
    {
        Menu::macro('front', function () {
            return Menu::new()->setActiveFromRequest(locale());
        });

        Menu::macro('main', function () {
            return Menu::front()
                ->addClass('nav navbar-nav')
                ->url('/', 'Home');
        });

        Menu::macro('language', function () {
            return locales()->reduce(function (Menu $menu, string $locale) {
                $menu->url($locale, $locale);
            }, Menu::front());
        });
    }
}
