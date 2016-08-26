<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    protected function guard()
    {
        return Auth::guard('front');
    }
}
