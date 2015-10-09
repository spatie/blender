<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Activity;

class AuthController extends Controller
{
    use ThrottlesLogins;

    /**
     * The Guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;

        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if ($this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        if (!$this->auth->attempt($credentials, true)) {
            $this->incrementLoginAttempts($request);

            return redirect($this->loginPath())
                ->withInput($request->only('email'))
                ->withErrors([
                    $this->loginUsername() => trans('auth.logInError'),
                ]);
        }

        if ($this->auth->user()->cannot('login')) {
            $this->auth->logout();

            return redirect($this->loginPath())
                ->withErrors([
                    $this->loginUsername() => trans('auth.notActivatedError'),
                ]);
        }

        $this->clearLoginAttempts($request);

        Activity::log('Een admin logt in.');

        return redirect()->intended($this->auth->user()->getHomeUrl());
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        Activity::log('Admin logt uit');

        flash()->message(trans('auth.loggedOut'));

        $this->auth->logout();

        return redirect('/nl/auth/login');
    }

    /**
     * Get the path to the login route.
     *
     * @return string
     */
    protected function loginPath()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : url(locale().'/auth/login');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    protected function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'email';
    }
}
