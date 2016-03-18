<?php

namespace App\Services\Navigation;

use Illuminate\Support\ServiceProvider;
use HTML;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

class NavigationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->make(Breadcrumbs::class)->register();
    }

    public function register()
    {
        $this->app->singleton('section', Section::class);
        $this->registerMenus();
    }

    protected function registerMenus()
    {
        Menu::macro('module', function (string $action, string $name) {
            return $this->action("Back\\{$action}", fragment("back.{$name}"));
        });

        Menu::macro('moduleGroup', function ($title) {
            $menu = Menu::new();

            return $menu
                ->addParentClass('menu_group')
                ->setParentAttribute('data-menu-group', $title)
                ->registerFilter(function (Link $link) use ($menu) {
                    if ($menu->count() >= 1) {
                        $link->addParentClass('-secondary');
                    }

                    $link->addParentClass('menu_group_item');
                })
                ->setActiveFromRequest('/blender');
        });

        Menu::macro('startSecondary', function () {
            return $this->registerFilter(function (Link $link) {
                $link->addParentClass('-secondary');
            });
        });

        Menu::macro('backMain', function () {
            return Menu::new()
                ->setActiveFromRequest('/blender')
                ->addClass('menu_groups')
                ->setAttribute('data-menu-groups')
                ->add(Menu::new()
                    ->addParentClass('menu_group -single')
                    ->add(
                        Link::action('Back\DashboardController@index', fragment('back.dashboard.title'))
                            ->addParentClass('menu_group_item')
                    )
                )
                ->add(Menu::moduleGroup('inhoud')
                    ->module('ArticleController@index', 'articles.title')
                    ->module('NewsItemController@index', 'newsItems.title')
                    ->module('PersonController@index', 'people.title')
                )
                ->add(Menu::moduleGroup('modules')
                    ->module('FragmentController@index', 'fragments.title')
                    ->module('FormResponseController@showDownloadButton', 'formResponses.title')
                    ->module('TagController@index', 'tags.title')
                )
                ->add(Menu::moduleGroup('configuratie')
                    ->module('FrontUserController@index', 'frontUsers.title')
                    ->module('BackUserController@index', 'backUsers.title')
                    ->module('ActivitylogController@index', 'log.title')
                    ->module('StatisticsController@index', 'statistics.menuTitle')
                );
        });

        Menu::macro('backUser', function () {
            return Menu::new()
                ->add(Link::action('Back\BackUserController@edit', HTML::avatar(auth()->user(), '-small') . '<span class=":responsive-desktop-only">' . auth()->user()->email . '</span>', [current_user()->id]))
                ->add(Link::action('Back\AuthController@getLogout', '<span class="fa fa-power-off"></span>')->addClass('menu_circle -log-out')->setAttribute('title', 'log out'));
        });
    }
}
