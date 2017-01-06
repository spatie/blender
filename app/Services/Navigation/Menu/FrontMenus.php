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
            return Menu::build(locales(), function (Menu $menu, string $locale) {
                return $menu->url($locale, strtoupper($locale));
            })->setActiveFromRequest();
        });

        Menu::macro('articleSiblings', function (Article $article) {
            return $article->siblings->reduce(function (Menu $menu, Article $article) {
                return $menu->url($article->url, $article->name);
            }, Menu::front());
        });

        Menu::macro('article', function ($article) {
            $article = $article instanceof Article ? $article : article($article);

            return $this->url($article->url, $article->name);
        });
    }
}
