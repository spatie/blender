<?php

namespace App\Services\Mailers;

use App\Events\ContactFormWasSubmitted;
use App\Services\Auth\Back\Events\UserWasCreated;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Mail\Message;
use Password;

class AdminMailer
{
    use SendsMails;

    public function subscribe(Dispatcher $events)
    {
        $events->listen(UserWasCreated::class, [$this, 'userWasCreated']);
        $events->listen(ContactFormWasSubmitted::class, [$this, 'contactFormWasSubmitted']);
    }

    public function userWasCreated(UserWasCreated $event)
    {
        Password::broker('back')->sendResetLink(['email' => $event->user->email], function (Message $message) {
            $message->subject(fragment('passwords.subjectEmailNewUser'));
        });
    }

    public function contactFormWasSubmitted(ContactFormWasSubmitted $event)
    {
        $this->sendMail(
            config('mail.recipients.questionForm'),
            'Een nieuwe reactie op ' . config('app.url'),
            'email.admin.contactFormSubmitted',
            $event->formResponse->toArray()
        );
    }
}
