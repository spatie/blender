<?php

namespace App\Mail;

use App\Mail\Member\Welcome;
use App\Services\Auth\Back\Events\UserCreated as BackUserCreated;
use App\Services\Auth\Front\Events\UserCreatedThroughBack as FrontUserCreatedThroughBack;
use App\Services\Auth\Front\Events\UserRegistered as FrontUserRegistered;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class EventHandler
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(FrontUserRegistered::class, function (FrontUserRegistered $event) {
            Mail::send(new Welcome($event->user));
        });

        $events->listen(FrontUserCreatedThroughBack::class, function (FrontUserCreatedThroughBack $event) {
            Password::broker('front')->sendResetLink(['email' => $event->user->email], function (Message $message) {
                $message->subject('Welcome to '.config('app.url'));
            });
        });

        $events->listen(BackUserCreated::class, function (BackUserCreated $event) {
            Password::broker('back')->sendResetLink(['email' => $event->user->email], function (Message $message) {
                $message->subject('Welcome to '.config('app.url'));
            });
        });
    }
}
