<?php

namespace App\Mailers;

use App\Events\ContactFormWasSubmitted;
use App\Events\UserWasCreated;
use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;
use App\Services\EventHandler;

class AdminMailerEventHandler extends EventHandler
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
        $this->mailer->sendContactFormDetails($event->formResponse);
    }
}
