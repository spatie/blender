<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Back\RedirectRequest;
use App\Models\Redirect;

class RedirectsController extends ModuleController
{
    protected function make(): Redirect
    {
        return Redirect::create();
    }

    protected function updateFromRequest(Redirect $redirect, RedirectRequest $request)
    {
        $redirect->old_url = $request->get('old_url');
        $redirect->new_url = $request->get('new_url');

        $this->updateModel($redirect, $request);
    }
}
