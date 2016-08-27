<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller as BaseController;
use Password;

class Controller extends BaseController
{
    protected function guard()
    {
        return Auth::guard('front');
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('front');
    }
}
