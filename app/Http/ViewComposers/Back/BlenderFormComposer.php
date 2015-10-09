<?php

namespace App\Http\ViewComposers\Back;

use BlenderForm;
use Illuminate\Contracts\View\View;
use function spatie\array_keys_exist;

class BlenderFormComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        if (array_keys_exist(['module', 'model', 'errors'], $view->getData())) {
            BlenderForm::init($view['module'], $view['model'], $view['errors']);
        }
    }
}
