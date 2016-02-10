<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    use ResetsPasswords;

    protected $guard = 'front';
    protected $linkRequestView = 'front.auth.password';
    protected $resetView = 'front.auth.reset';
}
