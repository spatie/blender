<?php

namespace App\Services\Mailers;

use App\Events\UserWasActivated;
use App\Services\Auth\Front\Events\UserWasCreatedThroughBack;
use App\Services\Auth\Front\Events\UserWasRegistered;
use Illuminate\Contracts\Events\Dispatcher;

class MemberMailerEventHandler
{
    public function __construct(MemberMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            UserWasActivated::class,
            static::class.'@whenUserWasActivated'
        );

        $events->listen(
            UserWasCreatedThroughBack::class,
            static::class.'@whenUserWasCreatedThroughBack'
        );
    }

    public function whenUserWasRegistered(UserWasRegistered $event)
    {
        $this->mailer->sendWelcomeMail($event->user);
    }

    public function whenUserWasCreatedThroughBack(UserWasCreatedThroughBack $event)
    {
        $this->mailer->sendPasswordEmail($event->user);
    }
}
