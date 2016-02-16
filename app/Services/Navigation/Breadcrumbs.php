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
            $breadcrumbs->push($user->present()->fullName, action('Back\BackUserController@edit', $user->id));
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
            $breadcrumbs->push($user->present()->fullName, action('Back\FrontUserController@edit', $user->id));
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
            function ($breadcrumbs) use ($ucname, $plural) {
                $breadcrumbs->push(
                    fragment("back.{$plural}.title"),
                    action("Back\\{$ucname}Controller@index")
                );
            }
        );

        BreadCrumbsManager::register(
            "{$singular}Back",
            function ($breadcrumbs, $model) use ($singular, $ucname, $plural) {
                $breadcrumbs->parent("{$singular}ListBack");

                $breadcrumbs->push(
                    $model->isDraft() ? fragment("back.{$plural}.new") :
                        (isset($model->name) ? $model->name : ucfirst(fragment('back.change'))),
                    action("Back\\{$ucname}Controller@create")
                );
            }
        );
    }
}
