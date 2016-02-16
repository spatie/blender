<?php

namespace App\Services\Mailers;

use App\Events\ContactFormWasSubmitted;
use App\Events\UserWasCreated;
use App\Services\Auth\Back\Enums\UserRole;
use App\Services\Auth\Back\Enums\UserStatus;
use Illuminate\Contracts\Events\Dispatcher;

class AdminMailerEventHandler
{
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
        $this->mailer->sendContactFormDetails($event->formResponse);
    }

    public function subscribe(Dispatcher $events)
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
