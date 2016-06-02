<?php

namespace App\Services\Mailers;

use App\Events\UserWasActivated;
use App\Services\Auth\Front\Events\UserWasCreatedThroughBack;
use App\Services\Auth\Front\Events\UserWasRegistered;
use Illuminate\Contracts\Events\Dispatcher;

class MemberMailerEventHandler
{
    use SendsMails;
    
    public function whenUserWasRegistered(UserWasRegistered $event)
    {
        $this->sendTo(
            $event->user->email,
            'Welkom bij ' . config('app.url'),
            'emails.auth.front.welcome',
            ['userId' => $event->user->id]
        );
    }

    public function whenUserWasCreatedThroughBack(UserWasCreatedThroughBack $event)
    {
        Password::broker('front')->sendResetLink(['email' => $event->user->email], function (Message $message) {
            $message->subject('Welkom bij ' . config('app.url'));
        });
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(UserWasActivated::class, [$this, 'whenUserWasActivated']);
        $events->listen(UserWasCreatedThroughBack::class, [$this, 'whenUserWasCreatedThroughBack']);
    }
}
