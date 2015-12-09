<?php

namespace App\Services\Mailers;

use App\Events\ContactFormWasSubmitted;
use App\Events\UserWasCreated;
use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;

class AdminMailerEventHandler
{
    /**
     * @param AdminMailer $mailer
     */
    public function __construct(AdminMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function whenUserWasCreated(UserWasCreated $event)
    {
        if ($event->user->hasRole(UserRole::ADMIN)) {
            $this->mailer->sendPasswordEmail($event->user);
        }

        if ($event->user->status == UserStatus::WAITING_FOR_APPROVAL) {
            $this->mailer->sendApprovalMail($event->user);
        }
    }

    public function whenContactFormWasSubmitted(ContactFormWasSubmitted $event)
    {
        $this->mailer->sendContactFormDetails($event->formResponse->toArray());
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     *
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen(
            UserWasCreated::class,
            self::class.'@whenUserWasCreated'
        );

        $events->listen(
            ContactFormWasSubmitted::class,
            self::class.'@whenContactFormWasSubmitted'
        );
    }
}
