<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Auth\Front\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $guard = 'front';
    protected $loginView = 'front.auth.login';
    protected $registerView = 'front.auth.register';

    public function redirectPath() : string
    {
        return current_user()->getHomeUrl();
    }

    protected function authenticated(Request $request, User $user)
    {
        if (! $user->isActive()) {
            auth()->guard('front')->logout();

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
                $this->loginUsername() => fragment('auth.notActivatedError'),
            ]);
    }

    protected function validator(array $input) : Validator
    {
        return validator($input, [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'postal' => 'required',
            'city' => 'required',
            'country' => 'required',
            'telephone' => 'required',
            'email' => 'required|email|unique:users_front,email',
            'password' => 'required|confirmed|min:8',
        ]);
    }

    protected function create(array $input) : User
    {
        return User::register($input);
    }
}
