<?php

namespace App\Services\Navigation;

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
        'article' => 'articles',
        'newsItem' => 'newsItems',
        'person' => 'people',
        'tag' => 'tags',
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

        foreach ($this->modules as $singular => $plural) {
            $this->module($singular, $plural);
        }
    }

    protected function registerFragmentBreadcrumbs()
    {
        BreadCrumbsManager::register('fragments', function ($breadcrumbs) {
            $breadcrumbs->push(trans('back-fragments.title'), action('Back\FragmentController@index'));
        });

        BreadCrumbsManager::register('fragmentDetail', function ($breadcrumbs, $string) {
            $breadcrumbs->parent('fragments');
            $breadcrumbs->push($string->name, action('Back\FragmentController@edit', $string->id));
        });
    }

    protected function registerUserBreadcrumbs()
    {
        BreadCrumbsManager::register('userListBack', function ($breadcrumbs, $user) {

            $breadcrumbs->push(trans('back-users.title'), '/blender/user/admin');
            $breadcrumbs->push(trans("back-users.role.{$user->role}.plural"), action('Back\UserController@index', ['role' => $user->role]));
        });

        BreadCrumbsManager::register('newUserBack', function ($breadcrumbs, $user) {
            $breadcrumbs->parent('userListBack', $user);
            $breadcrumbs->push(trans('back-users.new'), action('Back\UserController@create', ['role' => $user->role]));
        });

        BreadCrumbsManager::register('editUserBack', function ($breadcrumbs, $user) {
            $breadcrumbs->parent('userListBack', $user);
            $breadcrumbs->push($user->present()->fullName, action('Back\UserController@edit', $user->id));
        });
    }

    /**
     * @param string $singular
     * @param string $plural
     */
    protected function module($singular, $plural)
    {
        $ucname = ucfirst($singular);

        BreadCrumbsManager::register(
            "{$singular}ListBack",
            function ($breadcrumbs) use ($singular, $ucname, $plural) {
                $breadcrumbs->push(
                    trans("back-{$plural}.title"),
                    action("Back\\{$ucname}Controller@index")
                );
            }
        );

        BreadCrumbsManager::register(
            "{$singular}Back",
            function ($breadcrumbs, $model) use ($singular, $ucname, $plural) {
                $breadcrumbs->parent("{$singular}ListBack");

                $breadcrumbs->push(
                    $model->isDraft() ? trans("back-{$plural}.new") :
                        (isset($model->name) ? $model->name : ucfirst(trans('back.change'))),
                    action("Back\\{$ucname}Controller@create")
                );
            }
        );
    }
}
