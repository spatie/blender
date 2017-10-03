<?php

namespace App\Http\Controllers\Back;

use App\Models\Redirect;
use Illuminate\Http\Request;

class RedirectsController extends Controller
{
    protected function make(): Redirect
    {
        return Redirect::create();
    }

    protected function updateFromRequest(Redirect $redirect, Request $request)
    {
        $redirect->old_url = $request->get('old_url');
        $redirect->new_url = $request->get('new_url');

        $redirect->save();
    }

    protected function validationRules(): array
    {
        return [
            'old_url' => 'required',
            'new_url' => 'required|different:old_url',
        ];
    }
}
