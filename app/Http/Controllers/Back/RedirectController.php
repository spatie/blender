<?php

namespace App\Http\Controllers\Back;

use App\Models\Redirect;

class RedirectController extends ModuleController
{
    protected $modelName = 'Redirect';
    protected $moduleName = 'redirects';

    protected function make()
    {
        return Redirect::create();
    }
}
