<?php

namespace App\Services\Navigation\Breadcrumbs;

use Breadcrumbs as BreadCrumbsManager;
use DaveJamesMiller\Breadcrumbs\Manager;

class Breadcrumbs
{
    /** @var \DaveJamesMiller\Breadcrumbs\Manager */
    protected $manager;

    /** @var array */
    protected $modules = [
        'articles',
        'news',
        'people',
        'tags',
        'redirects',
    ];

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
        BreadCrumbsManager::register('fragmentsBack', function ($breadcrumbs) {
            $breadcrumbs->push(fragment('back.fragments.title'), action('Back\FragmentsController@index'));
        });

        BreadCrumbsManager::register('fragmentsDetailBack', function ($breadcrumbs, $string) {
            $breadcrumbs->parent('fragmentsBack');
            $breadcrumbs->push($string->name, action('Back\FragmentsController@edit', $string->id));
        });
    }

    protected function registerUserBreadcrumbs()
    {
        BreadCrumbsManager::register('administratorsListBack', function ($breadcrumbs) {
            $breadcrumbs->push(fragment('back.administrators.title'), action('Back\AdministratorsController@index'));
        });

        BreadCrumbsManager::register('administratorsCreateBack', function ($breadcrumbs) {
            $breadcrumbs->parent('administratorsListBack');
            $breadcrumbs->push(fragment('back.administrators.new'), action('Back\AdministratorsController@create'));
        });

        BreadCrumbsManager::register('administratorsEditBack', function ($breadcrumbs, $user) {
            $breadcrumbs->parent('administratorsListBack', $user);
            $breadcrumbs->push($user->name, action('Back\AdministratorsController@edit', $user->id));
        });

        BreadCrumbsManager::register('membersListBack', function ($breadcrumbs) {
            $breadcrumbs->push(fragment('back.members.title'), action('Back\MembersController@index'));
        });

        BreadCrumbsManager::register('membersNewBack', function ($breadcrumbs) {
            $breadcrumbs->parent('membersListBack');
            $breadcrumbs->push(fragment('back.members.new'), action('Back\MembersController@create'));
        });

        BreadCrumbsManager::register('membersEditBack', function ($breadcrumbs, $user) {
            $breadcrumbs->parent('membersListBack', $user);
            $breadcrumbs->push($user->name, action('Back\MembersController@edit', $user->id));
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
