<?php

namespace App\Http\Controllers\Front\Auth;

use App\Services\Auth\Front\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    protected $redirectTo = '/';

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

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
        if (!$user = User::findByToken($token)) {
            flash()->error(trans('passwordReset.invalidToken'));

            return redirect()->to(login_url());
        };

        return view('front.auth.resetPassword')->with(
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
}
