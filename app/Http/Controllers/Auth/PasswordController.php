<?php

namespace App\Http\Controllers\Auth;

use Activity;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\Request;
use Lang;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use URL;

class PasswordController extends Controller
{
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

    /**
     * Create a new password controller instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard          $auth
     * @param \Illuminate\Contracts\Auth\PasswordBroker $passwords
     */
    public function __construct(Guard $auth, PasswordBroker $passwords)
    {
        $this->auth = $auth;
        $this->passwords = $passwords;

        $this->middleware('guest');
    }

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The password broker implementation.
     *
     * @var PasswordBroker
     */
    protected $passwords;

    /**
     * Display the form to request a password reset link.
     *
     * @return Response
     */
    public function getEmail()
    {
        return view('auth.password');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required']);

        $response = $this->passwords->sendResetLink($request->only('email'), function ($message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case PasswordBroker::RESET_LINK_SENT:
                Activity::log('Een wachtwoord reset mail werd verstuurd naar '.$request->get('email').'.');

                flash()->message(Lang::get($response));

                return redirect(URL::route('login'));

            case PasswordBroker::INVALID_USER:
                flash()->error(Lang::get($response));

                return redirect()->back();
        }
    }

    /**
     * Get the e-mail subject line to be used for the reset link email.
     *
     * @return string
     */
    protected function getEmailSubject()
    {
        return trans('passwords.subjectEmail');
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param string         $token
     * @param UserRepository $userRepository
     *
     * @return Response
     */
    public function getReset($token = null, UserRepository $userRepository)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException();
        }

        $user = $userRepository->findByToken($token);

        if (!$user) {
            flash()->error(trans('auth.invalidResetLink'));

            return redirect(URL::route('login'));
        }

        return view('auth.reset')->with(compact('token', 'user'));
    }

    /**
     * Reset the given user's password.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = $this->passwords->reset($credentials, function ($user, $password) {
            $user->password = $password;

            $user->save();

            $this->auth->login($user);

        });

        if ($this->auth->user()->cannot('login')) {
            $this->auth->logout();

            flash('Uw wachtwoord werd gewijzigd, maar uw account is nog niet actief.');

            redirect()->back('/nl/auth/login');
        }

        switch ($response) {
            case PasswordBroker::PASSWORD_RESET:

                flash()->message(trans('auth.passwordChanged'));

                return redirect($this->auth->user()->getHomeUrl());

            case PasswordBroker::INVALID_TOKEN:
                flash()->message(trans('auth.resetLinkExpired'));

                return redirect()->back()
                    ->withErrors(['email' => trans($response)]);

            default:
                flash()->error(trans('auth.correctFormErrors'));

                return redirect()->back()
                    ->withInput($request->only('password'))
                    ->withErrors(['email' => trans($response)]);
        }
    }
}
