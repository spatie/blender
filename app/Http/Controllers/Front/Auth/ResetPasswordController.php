<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\Front\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    protected $redirectTo = '/';

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
        if (! $user = User::where('email', $request->email)->first()) {
            flash()->error(__('passwords.token'));

            return redirect()->to(route('login'));
        }

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
        flash()->info(__($response));

        return redirect($this->redirectPath());
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        flash()->error(__('passwords.token'));

        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => __($response)]);
    }

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
