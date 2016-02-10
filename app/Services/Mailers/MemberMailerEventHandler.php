<?php

namespace App\Services\Mailers;

use App\Events\UserWasActivated;
use App\Services\Auth\Front\Enums\UserRole;
use App\Services\Auth\Front\Events\UserWasRegistered;
use Illuminate\Contracts\Events\Dispatcher;

class MemberMailerEventHandler
{
    public function __construct(MemberMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function whenUserWasRegistered(UserWasRegistered $event)
    {
        $this->mailer->sendWelcomeMail($event->user);
    }

    public function whenUserWasActivated(UserWasActivated $event)
    {
        if ($event->user->hasRole(UserRole::MEMBER)) {
            $this->mailer->sendApprovedMail($event->user);
        }
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            UserWasActivated::class,
            self::class.'@whenUserWasActivated'
        );

        $events->listen(
            UserWasRegistered::class,
            self::class.'@whenUserWasRegistered'
        );
    }
}
