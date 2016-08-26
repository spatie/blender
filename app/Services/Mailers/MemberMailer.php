<?php

namespace App\Services\Mailers;

use App\Services\Auth\Front\Events\UserCreatedThroughBack;
use App\Services\Auth\Front\Events\UserRegistered;
use Illuminate\Contracts\Events\Dispatcher;

class MemberMailer
{
    use SendsMails;

    public function subscribe(Dispatcher $events)
    {
        $events->listen(UserCreatedThroughBack::class, [$this, 'userCreatedThroughBack']);
    }

    public function userRegistered(UserRegistered $event)
    {
        $this->sendTo(
            $event->user->email,
            'Welkom bij ' . config('app.url'),
            'email.auth.front.welcome',
            ['userId' => $event->user->id]
        );
    }

    public function userCreatedThroughBack(UserCreatedThroughBack $event)
    {
        Password::broker('front')->sendResetLink(['email' => $event->user->email], function (Message $message) {
            $message->subject('Welkom bij ' . config('app.url'));
        });
    }
}
