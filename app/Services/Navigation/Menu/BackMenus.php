<?php

namespace App\Services\Navigation\Menu;

use Html;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

class BackMenus
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

        Menu::macro('module', function (string $action, string $name) {
            return $this->action("Back\\{$action}", fragment("back.{$name}"));
        });

        Menu::macro('backMain', function () {
            return Menu::back()
                ->addClass('menu_groups')
                ->setAttribute('data-menu-groups')
                ->add(Menu::moduleGroup('content')
                    ->module('ArticleController@index', 'articles.title')
                    ->module('NewsItemController@index', 'newsItems.title')
                    ->module('PersonController@index', 'people.title'))
                ->add(Menu::moduleGroup('modules')
                    ->module('FragmentController@index', 'fragments.title')
                    ->module('FormResponseController@showDownloadButton', 'formResponses.title')
                    ->module('TagController@index', 'tags.title'))
                ->add(Menu::moduleGroup('users')
                    ->module('FrontUserController@index', 'frontUsers.title')
                    ->module('BackUserController@index', 'backUsers.title'))
                ->add(Menu::moduleGroup('system')
                    ->module('ActivitylogController@index', 'log.title')
                    ->module('StatisticsController@index', 'statistics.menuTitle'));
        });

        Menu::macro('backUser', function () {

            $avatar = Html::avatar(current_user(), '-small').
                el('span.:response-desktop-only', current_user()->email);

            return Menu::new()
                ->add(Link::action('Back\BackUserController@edit', $avatar, [current_user()->id]))
                ->html(view('back.auth._partials.logoutForm'));
        });
    }
}
