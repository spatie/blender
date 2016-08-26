<?php

namespace App\Http\Controllers\Back\Auth;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    protected function guard()
    {
        return Auth::guard('back');
    }
}
