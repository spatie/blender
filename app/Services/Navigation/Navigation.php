<?php

namespace App\Services\Navigation;

use App\Models\Enums\UserRole;
use HTML;
use Menu;
use Request;

class Navigation
{
    public function getFrontMainMenu()
    {
        $menu = Menu::handler('main', ['class' => 'nav navbar-nav'])
            ->add('/', 'Home');

        return $menu;
    }

    public function getLanguageMenu()
    {
        $menu = Menu::handler('language', ['class' => 'navigation']);

        foreach (config('app.locales') as $locale) {
            $menu->add('/'.$locale, $locale);
        }

        return $menu;
    }

    public function getBackLanguageMenu()
    {
        $menu = Menu::handler('backLanguage', ['class' => 'navigation']);

        foreach (config('app.backLocales') as $locale) {
            $menu->add('/'.$locale.'/auth/login', $locale);
        }

        $menu = $this->setActiveMenuItem($menu, function ($item) {
            return app()->getLocale() == explode('/', trim($item->getContent()->getUrl(), '/'))[0];
        });

        return $menu;
    }

    public function getBackContentMenu()
    {
        $menu = Menu::handler('backContent');
        $menu->add(action('Back\ArticleController@index', [], false), trans('back-articles.title'), null, null, ['class'=>'menu_group_item']);
        $menu->add(action('Back\NewsItemController@index', [], false), trans('back-newsItems.title'), null, null, ['class'=>'menu_group_item -secondary']);
        $menu->add(action('Back\PersonController@index', [], false), trans('back-people.title'), null, null, ['class'=>'menu_group_item -secondary']);

        $menu = $this->setActiveMenuItem($menu, function ($item) {
            return str_replace('/blender/', '/', $item->getContent()->getUrl()) == ('/'.Request::segment(2));
        });

        return $menu;
    }

    public function getBackModuleMenu()
    {
        $menu = Menu::handler('backModule');
        $menu->add(action('Back\FragmentController@index', [], false), trans('back-fragments.title'), null, null, ['class'=>'menu_group_item']);
        $menu->add(action('Back\FormResponseController@showDownloadButton', [], false), trans('back-formResponses.title'), null, null, ['class'=>'menu_group_item -secondary']);
        $menu->add(action('Back\TagController@index', [], false), trans('back-tags.title'), null, null, ['class'=>'menu_group_item -secondary']);

        $menu = $this->setActiveMenuItem($menu, function ($item) {
            return str_replace('/blender/', '/', $item->getContent()->getUrl()) == ('/'.Request::segment(2));
        });

        return $menu;
    }


    public function getBackServiceMenu()
    {
        $menu = Menu::handler('backService');

        $menu->add(action('Back\UserController@redirectToDefaultIndex', [], false), trans('back-users.title'), null, null, ['class'=>'menu_group_item']);
        $menu->add(action('Back\ActivitylogController@index', [], false), 'Log', null, null, ['class'=>'menu_group_item -secondary']);
        $menu->add(action('Back\StatisticsController@index', [], false), trans('back-statistics.menuTitle'), null, null, ['class'=>'menu_group_item -secondary']);

        $menu = $this->setActiveMenuItem($menu, function ($item) {
            return str_replace('/blender/', '/', $item->getContent()->getUrl()) == ('/'.Request::segment(2));
        });

        return $menu->render();
    }

    public function getBackDashboardMenu()
    {
        $menu = Menu::handler('backNavigation');

        $menu->add(action('Back\DashboardController@index', [], false), 'Dashboard', null, null, ['class'=>'menu_group_item']);

        $menu = $this->setActiveMenuItem($menu, function ($item) {
            return str_replace('/blender/', '/', $item->getContent()->getUrl()) == ('/'.Request::segment(2));
        });

        return $menu->render();
    }

    public function getBackUserMenu()
    {
        $menu = Menu::handler('backUser');

        $menu->add(action('Back\UserController@edit', ['id' => auth()->user()->id], false), HTML::avatar(auth()->user(), '-small') . '<span class=":responsive-desktop-only">' . auth()->user()->email . '</span>', null, null);
        $menu->add(action('Auth\AuthController@getLogout', [], false), '<span class="fa fa-power-off"></span>', null, ['class' => 'menu_circle -log-out', 'title' => 'log out']);

        $menu = $this->setActiveMenuItem($menu, function ($item) {
            return str_replace('/blender/', '/', $item->getContent()->getUrl()) == ('/'.Request::segment(2));
        });

        return $menu->render();
    }

    public function getBackUserRoleMenu()
    {
        if (count(UserRole::values()) == 1) {
            return '';
        }

        $menu = Menu::handler('backUserRole');

        foreach (UserRole::values() as $role) {
            $menu->add("/blender/user/{$role}", trans("back-users.role.{$role}.plural"));
        }

        $menu = $this->setActiveMenuItem($menu, function ($item) {
            return str_replace('/blender/', '/', $item->getContent()->getUrl()) == ('/'.Request::segment(2));
        });

        return '<nav class="menu_tabs">'.$menu->render().'</nav>';
    }

    private function setActiveMenuItem($menu, callable $activeTest)
    {
        $menu->getItemsByContentType('Menu\Items\Contents\Link')->map(function ($item) use ($activeTest) {
            if ($activeTest($item)) {
                $item->addClass('active');
            }
        });

        return $menu;
    }
}
