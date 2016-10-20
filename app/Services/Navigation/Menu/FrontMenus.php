<?php

namespace App\Services\Navigation\Menu;

use app\Models\Article;
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
                ->addClass('nav__list')
                ->url('/', 'Home');
        });

        Menu::macro('language', function () {
            return locales()->reduce(function (Menu $menu, string $locale) {
                $menu->url($locale, $locale);
            }, Menu::front());
        });

        Menu::macro('articleSiblings', function (Article $article) {
            return $article->siblings->reduce(function (Menu $menu, Article $article) {
                return $menu->url($article->fullUrl, $article->name);
            }, Menu::front());
        });
    }
}
