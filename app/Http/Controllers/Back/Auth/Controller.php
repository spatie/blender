<?php

namespace App\Http\Controllers\Back\Auth;

use App\Http\Controllers\Controller as BaseController;
use Password;

class Controller extends BaseController
{
    protected function guard()
    {
        return Auth::guard('back');
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('back');
    }
}
