<?php

namespace App\Mail;

use App\Services\Auth\Front\Events\UserCreatedThroughBack;
use App\Services\Auth\Front\Events\UserRegistered;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
use Mail;

class EventHandler
{

    public function subscribe(Dispatcher $events)
    {
        $events->listen(UserRegistered::class, function (UserRegistered $event) {
            Mail::send(new Welcome($event->user));
        });

        $events->listen(UserCreatedThroughBack::class, function (UserCreatedThroughBack $event) {
            Password::broker('front')->sendResetLink(['email' => $event->user->email], function (Message $message) {
                $message->subject('Welkom bij ' . config('app.url'));
            });
        });
    }
}
