<?php

namespace App\Services\Navigation\Menu;

use HTML;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

class BackMenus
{
    public function register()
    {
        Menu::macro('backMain', function () {
            return Menu::back()
                ->addClass('menu_groups')
                ->setAttribute('data-menu-groups')
                ->add(Menu::back()
                    ->addParentClass('menu_group -single')
                    ->add(
                        Link::action('Back\DashboardController@index', fragment('back.dashboard.title'))
                            ->addParentClass('menu_group_item')
                    )
                )
                ->add(Menu::moduleGroup('content')
                    ->module('NewsItemController@index', 'newsItems.title')
                    ->startSecondary()
                    ->module('PersonController@index', 'people.title')
                    ->module('ArticleController@index', 'articles.title')
                )
                ->add(Menu::moduleGroup('modules')
                    ->module('FormResponseController@showDownloadButton', 'formResponses.title')
                    ->startSecondary()
                    ->module('TagController@index', 'tags.title')
                    ->module('FragmentController@index', 'fragments.title')
                )
                ->add(Menu::moduleGroup('configuration')
                    ->module('FrontUserController@index', 'frontUsers.title')
                    ->module('BackUserController@index', 'backUsers.title')
                    ->startSecondary()
                    ->module('ActivitylogController@index', 'log.title')
                    ->module('StatisticsController@index', 'statistics.menuTitle')
                );
        });

        Menu::macro('backUser', function () {

            $avatar = HTML::avatar(current_user(), '-small') .
                el('span.:response-desktop-only', current_user()->email);

            return Menu::new()
                ->add(Link::action('Back\BackUserController@edit', $avatar, [current_user()->id]))
                ->add(Link::action('Back\AuthController@getLogout', el('span.fa.fa-power-off'))
                    ->addClass('menu_circle -log-out')
                    ->setAttribute('title', 'log out')
                );
        });
    }
}
