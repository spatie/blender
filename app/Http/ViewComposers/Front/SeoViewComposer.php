<?php

namespace App\Http\ViewComposers\Front;

use Illuminate\Contracts\View\View;

class SeoViewComposer
{
    public function compose(View $view)
    {
        // We need the view factory here, not the view itself.
        $viewSections = app('view')->getSections();

        $hasTitle = array_key_exists('title', $viewSections);

        $view->with(compact('hasTitle'));
    }
}
