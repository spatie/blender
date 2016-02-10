<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    use ResetsPasswords;

    protected $guard = 'back';
    protected $linkRequestView = 'back.auth.password';
    protected $resetView = 'back.auth.reset';
}
