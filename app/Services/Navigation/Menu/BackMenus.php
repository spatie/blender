<?php

namespace App\Services\Navigation\Menu;

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
                ->setParentAttribute('data-menu-group', __($title))
                ->registerFilter(function (Link $link) {
                    $link->addParentClass('menu__group__item');
                });
        });

        Menu::macro('module', function (string $action, string $name) {
            return $this->action("Back\\{$action}", __($name));
        });

        Menu::macro('backMain', function () {
            return Menu::back()
                ->addClass('menu__groups')
                ->setAttribute('data-menu-groups')
                ->add(Menu::moduleGroup('Content')
                    ->module('ArticlesController@index', 'Articles')
                    ->module('NewsController@index', 'News')
                    ->module('PeopleController@index', 'Team'))
                ->add(Menu::moduleGroup('Modules')
                    ->module('FragmentsController@index', 'Fragments')
                    ->module('FormResponsesController@showDownloadButton', 'Responses')
                    ->module('RecipientsController@index', 'Recipients')
                    ->module('TagsController@index', 'Tags'))
                ->add(Menu::moduleGroup('Profiles')
                    ->module('MembersController@index', 'Members')
                    ->module('AdministratorsController@index', 'Administrators'))
                ->add(Menu::moduleGroup('System')
                    ->module('ActivitylogController@index', 'Log')
                    ->module('RedirectsController@index', 'Redirects')
                    ->module('StatisticsController@index', 'Statistics'));
        });

        Menu::macro('backUser', function () {
            $avatar = html()->avatar(current_user())->class('-small').
                html()->span(current_user()->email)->class(':response-desktop-only');

            return Menu::new()
                ->action('Back\AdministratorsController@edit', $avatar, [current_user()->id])
                ->html(view('back.auth.partials.logoutForm'));
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
