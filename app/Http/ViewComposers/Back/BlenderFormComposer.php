<?php

namespace App\Http\ViewComposers\Back;

use Illuminate\Contracts\View\View;
use function spatie\array_keys_exist;
use App\Services\Html\BlenderFormBuilder;

class BlenderFormComposer
{
    public function compose(View $view)
    {
        $viewData = $view->getData();

        if (! array_keys_exist(['module', 'model', 'errors'], $viewData)) {
            return;
        }

        app(BlenderFormBuilder::class)->init($viewData['module'], $viewData['model'], $viewData['errors']);
    }
}
