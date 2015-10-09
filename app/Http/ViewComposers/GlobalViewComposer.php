<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\View;

class GlobalViewComposer
{
    /**
     * @var Guard
     */
    private $auth;

    /**
     * Bind data to the view.
     *
     * @param Guard $auth
     *
     * @internal param View $view
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function compose(View $view)
    {
        $currentUser = $this->auth->user();

        $view->with(compact('currentUser'));
    }
}
