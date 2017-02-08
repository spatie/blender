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
                ->setParentAttribute('data-menu-group', fragment($title))
                ->registerFilter(function (Link $link) {
                    $link->addParentClass('menu__group__item');
                });
        });

        Menu::macro('module', function (string $action, string $name) {
            return $this->action("Back\\{$action}", $name);
        });

        Menu::macro('backMain', function () {
            return Menu::back()
                ->addClass('menu__groups')
                ->setAttribute('data-menu-groups')
                ->add(Menu::moduleGroup(__('Inhoud'))
                    ->module('ArticlesController@index', __('Artikels'))
                    ->module('NewsController@index', __('Artikels'))
                    ->module('PeopleController@index', __('Team')))
                ->add(Menu::moduleGroup(__('Modules'))
                    ->module('FragmentsController@index', __('Fragmenten'))
                    ->module('FormResponsesController@showDownloadButton', __('Reacties'))
                    ->module('TagsController@index', __('Tags')))
                ->add(Menu::moduleGroup(__('Profielen'))
                    ->module('MembersController@index', __('Leden'))
                    ->module('AdministratorsController@index', __('Administrators')))
                ->add(Menu::moduleGroup(__('Systeem'))
                    ->module('ActivitylogController@index', __('Log'))
                    ->module('RedirectsController@index', __('Redirects'))
                    ->module('StatisticsController@index', __('Statistieken')));
        });

        Menu::macro('backUser', function () {
            $avatar = html()->avatar(current_user())->class('-small').
                html()->span(current_user()->email)->class(':response-desktop-only');

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
