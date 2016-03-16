<?php

namespace App\Services\Mailers;

use App\Events\ContactFormWasSubmitted;
use App\Services\Auth\Back\Events\UserWasCreated;
use Illuminate\Contracts\Events\Dispatcher;

class AdminMailerEventHandler
{
    public function __construct(AdminMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function whenUserWasCreated(UserWasCreated $event)
    {
        $this->mailer->sendPasswordEmail($event->user);
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
