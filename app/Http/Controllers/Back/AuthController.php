<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Services\Auth\Back\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthenticatesUsers, ThrottlesLogins;

    protected $guard = 'back';
    protected $loginView = 'back.auth.login';

    public function redirectPath() : string
    {
        return current_user()->getHomeUrl();
    }

    protected function authenticated(Request $request, User $user)
    {
        if (! $user->isActive()) {
            auth()->guard('back')->logout();

            return $this->sendInactiveAccountResponse($request);
        }

        return redirect()->intended($this->redirectPath());
    }

    protected function getFailedLoginMessage() : string
    {
        return fragment('auth.failed');
    }

    protected function sendInactiveAccountResponse($request)
    {
        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => trans('back-auth.inactiveAccountError'),
            ]);
    }
}
