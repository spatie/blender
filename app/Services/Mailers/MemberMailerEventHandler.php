<?php

namespace App\Services\Mailers;

use App\Events\UserWasActivated;
use App\Services\Auth\Front\Enums\UserRole;
use Illuminate\Contracts\Events\Dispatcher;

class MemberMailerEventHandler
{
    public function __construct(MemberMailer $mailer)
    {
        $this->mailer = $mailer;
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
    }
}
