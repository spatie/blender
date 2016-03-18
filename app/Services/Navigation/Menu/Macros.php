<?php

namespace App\Services\Navigation\Menu;

use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

class Macros
{
    public function register()
    {
        Menu::macro('back', function () {
            return Menu::new()
                ->setActiveClass('-active')
                ->setActiveFromRequest('/blender');
        });

        Menu::macro('moduleGroup', function ($title) {
            return Menu::back()
                ->addParentClass('menu_group')
                ->setParentAttribute('data-menu-group', fragment("back.nav.{$title}"))
                ->registerFilter(function (Link $link) {
                    $link->addParentClass('menu_group_item');
                });
        });

        Menu::macro('startSecondary', function () {
            return $this->registerFilter(function (Link $link) {
                $link->addParentClass('-secondary');
            });
        });

        Menu::macro('module', function (string $action, string $name) {
            return $this->action("Back\\{$action}", fragment("back.{$name}"));
        });
    }
}
