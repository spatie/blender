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
                ->addParentClass('menu__group')
                ->setParentAttribute('data-menu-group', fragment("back.nav.{$title}"))
                ->registerFilter(function (Link $link) {
                    $link->addParentClass('menu__group__item');
                });
        });

        Menu::macro('module', function (string $action, string $name) {
            return $this->action("Back\\{$action}", fragment("back.{$name}"));
        });

        Menu::macro('backMain', function () {
            return Menu::back()
                ->addClass('menu__groups')
                ->setAttribute('data-menu-groups')
                ->add(Menu::moduleGroup('content')
                    ->module('ArticlesController@index', 'articles.title')
                    ->module('NewsController@index', 'news.title')
                    ->module('PeopleController@index', 'people.title'))
                ->add(Menu::moduleGroup('modules')
                    ->module('FragmentsController@index', 'fragments.title')
                    ->module('FormResponsesController@showDownloadButton', 'formResponses.title')
                    ->module('TagsController@index', 'tags.title'))
                ->add(Menu::moduleGroup('users')
                    ->module('MembersController@index', 'members.title')
                    ->module('AdministratorsController@index', 'administrators.title'))
                ->add(Menu::moduleGroup('system')
                    ->module('ActivitylogController@index', 'log.title')
                    ->module('RedirectsController@index', 'redirects.title')
                    ->module('StatisticsController@index', 'statistics.menuTitle'));
        });

        Menu::macro('backUser', function () {

            $avatar = Html::avatar(current_user(), '-small').
                el('span.:response-desktop-only', current_user()->email);

            return Menu::new()
                ->action('Back\AdministratorsController@edit', $avatar, [current_user()->id])
                ->html(view('back.auth._partials.logoutForm'));
        });

        Menu::macro('breadcrumbs', function (array $breadcrumbs) {
            return Menu::build($breadcrumbs, function (Menu $menu, $actionWithParameters, $label) {
                if (! is_array($actionWithParameters)) {
                    $actionWithParameters = [$actionWithParameters];
                }

                $action = array_shift($actionWithParameters);

                return $menu->action($action, $label, $actionWithParameters);
            })->addClass('breadcrumb')->setActiveFromRequest('/blender');
        });
    }
}
