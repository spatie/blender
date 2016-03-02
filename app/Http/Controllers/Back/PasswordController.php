<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Services\Auth\Back\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    use ResetsPasswords {
        ResetsPasswords::reset as defaultReset;
    }

    /** @var string */
    protected $guard;

    /** @var string */
    protected $broker;

    /** @var string */
    protected $linkRequestView;

    /** @var string */
    protected $resetView;

    /** @var string */
    protected $subject;

    public function __construct()
    {
        $this->guard = 'back';
        $this->broker = 'back';
        $this->linkRequestView = 'back.auth.password';
        $this->resetView = 'back.auth.reset';
        $this->subject = fragment('passwords.subjectEmail').' '.config('app.url');
    }

    public function redirectPath()
    {
        return action('Back\AuthController@getLogin');
    }

    public function showResetForm(Request $request, $token = null)
    {
        if (empty($token)) {
            return redirect()->action('Back\PasswordController@getEmail');
        }

        $user = User::findByToken($token);

        if (empty($user)) {
            return redirect()->action('Back\PasswordController@getEmail');
        }

        return view($this->resetView)->with(compact('user', 'token'));
    }

    public function reset(Request $request)
    {
        // We use min. 8 character passwords, so doing some extra validation here.
        $this->validate($request, [
            'password' => 'required|confirmed|min:8',
        ]);

        return $this->defaultReset($request);
    }

    protected function resetPassword($user, $password)
    {
        $user->password = $password;

        $user->save();

        auth()->guard($this->getGuard())->login($user);
    }
}
