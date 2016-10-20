<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Jobs\SubscribeToNewsletter;
use App\Models\Enums\UserStatus;
use App\Models\User;
use Event;
use Illuminate\Contracts\Auth\Guard;

class RegistrationController extends Controller
{
    /**
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function showRegistrationForm($role)
    {
        return view('auth.registration.'.$role);
    }

    public function saveUser(RegistrationRequest $request, $registrationRole)
    {
        $user = User::create(array_merge($request->except('password_confirmation', '_token'), [
            'role'   => $registrationRole,
            'status' => UserStatus::WAITING_FOR_APPROVAL,
        ]));

        Event::fire(new UserWasCreated($user));

        if ($request->has('subscribe_to_newsletter')) {
            $this->dispatch(new SubscribeToNewsletter($user));
        }

        if ($user->status == UserStatus::WAITING_FOR_APPROVAL) {
            flash()->message(trans('auth.waitingForApproval'));

            return redirect(route('login'));
        }

        $this->auth->login($user);

        flash()->success('U bent nu ingelogd.');

        return redirect($user->getHomeUrl());
    }
}
