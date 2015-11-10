<?php

namespace App\Services\Mailers;

use App\Events\UserWasActivated;
use App\Models\Enums\UserRole;
use App\Services\EventHandler;

class MemberMailerEventHandler
{
    /**
     * @param MemberMailer $mailer
     */
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

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen(
            UserWasActivated::class,
            self::class . '@whenUserWasActivated'
        );
    }
}
