<?php

namespace App\Http\ViewComposers\Shared;

use Illuminate\Contracts\View\View;

class GlobalViewComposer
{
    public function compose(View $view)
    {
        $currentUser = auth()->user();

        $view->with(compact('currentUser'));
    }
}
