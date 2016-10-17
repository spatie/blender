<?php

namespace App\Services\Navigation\Breadcrumbs;

use Breadcrumbs as BreadCrumbsManager;
use DaveJamesMiller\Breadcrumbs\Manager;

class Breadcrumbs
{
    /**
     * @var \DaveJamesMiller\Breadcrumbs\Manager
     */
    protected $manager;

    /**
     * @var array
     */
    protected $modules = [
        'articles',
        'news',
        'people',
        'tags',
        'redirects',
    ];

    /**
     * @param \DaveJamesMiller\Breadcrumbs\Manager $manager
     */
    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    public function register()
    {
        $this->registerFragmentBreadcrumbs();
        $this->registerUserBreadcrumbs();

        foreach ($this->modules as $name) {
            $this->module($name);
        }
    }

    protected function registerFragmentBreadcrumbs()
    {
        BreadCrumbsManager::register('fragments', function ($breadcrumbs) {
            $breadcrumbs->push(fragment('back.fragments.title'), action('Back\FragmentController@index'));
        });

        BreadCrumbsManager::register('fragmentDetail', function ($breadcrumbs, $string) {
            $breadcrumbs->parent('fragments');
            $breadcrumbs->push($string->name, action('Back\FragmentController@edit', $string->id));
        });
    }

    protected function registerUserBreadcrumbs()
    {
        BreadCrumbsManager::register('backUserListBack', function ($breadcrumbs) {
            $breadcrumbs->push(fragment('back.backUsers.title'), action('Back\BackUserController@index'));
        });

        BreadCrumbsManager::register('newBackUserBack', function ($breadcrumbs) {
            $breadcrumbs->parent('backUserListBack');
            $breadcrumbs->push(fragment('back.backUsers.new'), action('Back\BackUserController@create'));
        });

        BreadCrumbsManager::register('editBackUserBack', function ($breadcrumbs, $user) {
            $breadcrumbs->parent('backUserListBack', $user);
            $breadcrumbs->push($user->name, action('Back\BackUserController@edit', $user->id));
        });

        BreadCrumbsManager::register('frontUserListBack', function ($breadcrumbs) {
            $breadcrumbs->push(fragment('back.frontUsers.title'), action('Back\FrontUserController@index'));
        });

        BreadCrumbsManager::register('newFrontUserBack', function ($breadcrumbs) {
            $breadcrumbs->parent('frontUserListBack');
            $breadcrumbs->push(fragment('back.frontUsers.new'), action('Back\FrontUserController@create'));
        });

        BreadCrumbsManager::register('editFrontUserBack', function ($breadcrumbs, $user) {
            $breadcrumbs->parent('frontUserListBack', $user);
            $breadcrumbs->push($user->name, action('Back\FrontUserController@edit', $user->id));
        });
    }

    protected function module(string $name)
    {
        $controller = 'Back\\'.ucfirst($name).'Controller';

        BreadCrumbsManager::register(
            "{$name}ListBack",
            function ($breadcrumbs) use ($name, $controller) {
                $breadcrumbs->push(
                    fragment("back.{$name}.title"),
                    action("{$controller}@index")
                );
            }
        );

        BreadCrumbsManager::register(
            "{$name}Back",
            function ($breadcrumbs, $model) use ($name, $controller) {
                $breadcrumbs->parent("{$name}ListBack");

                $breadcrumbs->push(
                    $model->isDraft() ? fragment("back.{$name}.new") :
                        (isset($model->name) ? $model->name : ucfirst(fragment('back.change'))),
                        action("{$controller}@index")
                );
            }
        );
    }
}
