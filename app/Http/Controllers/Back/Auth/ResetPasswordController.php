<?php

namespace App\Http\Controllers\Back\Auth;

use Auth;
use Password;
use Illuminate\Http\Request;
use App\Services\Auth\Back\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    protected $redirectTo = '/blender';

    use ResetsPasswords;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param \Illuminate\Http\Request $request
     * @param string|null              $token
     *
     * @return \Illuminate\Http\Response
     */
    public function showResetForm(Request $request, $token = null)
    {
        if (! $user = User::findByToken($token)) {
            flash()->error(trans('passwordReset.invalidToken'));

            return redirect()->to(login_url());
        }

        return view('back.auth.resetPassword')->with(
            ['token' => $token, 'email' => $request->email, 'user' => $user]
        );
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param string $response
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendResetResponse($response)
    {
        flash()->info(trans($response));

        return redirect($this->redirectPath());
    }

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
