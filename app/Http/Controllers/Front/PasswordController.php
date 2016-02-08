<?php

namespace App\Http\Controllers\Front;

use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController
{
    use ResetsPasswords;

    /** @var \Illuminate\Contracts\Auth\Guard */
    protected $guard;

    public function __construct()
    {
        $this->guard = auth()->guard('front');
    }
}
