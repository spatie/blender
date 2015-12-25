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
            return (app()->getLocale() == explode('/', trim($item->getContent()->getUrl(), '/'))[0]);
        });

        return $menu;
    }

    public function getBackMainMenu()
    {
        $menu = Menu::handler('backMain');
        $menu->add(action('Back\ArticleController@index', [], false), trans('back-articles.title'));
        $menu->add(action('Back\NewsItemController@index', [], false), trans('back-newsItems.title'));
        $menu->add(action('Back\PersonController@index', [], false), trans('back-people.title'));
        $menu->add(action('Back\FormResponseController@showDownloadButton', [], false), trans('back-formResponses.title'));
        $menu->add(action('Back\FragmentController@index', [], false), trans('back-fragments.title'));
        $menu->add(action('Back\TagController@index', [], false), trans('back-tags.title'));

        $menu = $this->setActiveMenuItem($menu, function ($item) {
            return str_replace('/blender/', '/', $item->getContent()->getUrl()) == ('/'.Request::segment(2));
        });

        return $menu;
    }

    public function getBackServiceMenu()
    {
        $menu = Menu::handler('backService');

        $menu->add(action('Back\UserController@redirectToDefaultIndex', [], false), trans('back-users.title'));
        $menu->add(action('Back\ActivitylogController@index', [], false), 'Log');
        $menu->add(action('Back\StatisticsController@index', [], false), trans('back-statistics.menuTitle'));

        $menu = $this->setActiveMenuItem($menu, function ($item) {
            return str_replace('/blender/', '/', $item->getContent()->getUrl()) == ('/'.Request::segment(2));
        });

        return $menu->render();
    }

    public function getBackDashboardMenu()
    {
        $menu = Menu::handler('backNavigation');

        $menu->add(action('Back\DashboardController@index', [], false), 'Dashboard');

        $menu = $this->setActiveMenuItem($menu, function ($item) {
            return str_replace('/blender/', '/', $item->getContent()->getUrl()) == ('/'.Request::segment(2));
        });

        return $menu->render();
    }

    public function getBackUserMenu()
    {
        $menu = Menu::handler('backUser');

        $menu->add(url('/'), '<span class="menu_circle -front"></span><span class="menu_front-link_protocol">'.(Request::isSecure() ? '<span class="fa fa-lock"></span>' : '<span class="fa fa-unlock"></span>').'</span>'.Request::getHost(), null, ['class' => 'menu_front-link', 'target' => 'blender', 'title' => url('/')]);
        $menu->add(action('Back\UserController@edit', ['id' => auth()->user()->id], false), HTML::avatar(auth()->user(), '-small').auth()->user()->email, null, null);

        $menu->add('/nl/auth/logout', '<span class="fa fa-power-off"></span>', null, ['class' => 'menu_circle -log-out', 'title' => 'log out']);

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
