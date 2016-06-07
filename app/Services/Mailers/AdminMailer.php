<?php

namespace App\Services\Mailers;

use App\Events\ContactFormWasSubmitted;
use App\Services\Auth\Front\Events\UserWasActivated;
use App\Services\Auth\Back\Events\UserWasCreated;
use Illuminate\Contracts\Events\Dispatcher;

class AdminMailer
{
    use SendsMails;

    public function userWasCreated(UserWasCreated $event)
    {
        Password::broker('back')->sendResetLink(['email' => $event->user->email], function (Message $message) {
            $message->subject(fragment('passwords.subjectEmailNewUser'));
        });
    }

    public function contactFormWasSubmitted(ContactFormWasSubmitted $event)
    {
        collect(config('mail.questionFormRecipients'))->each(function (string $email) use ($event) {
            $this->sendMail(
                $email,
                'Een nieuwe reactie op ' . config('app.url'),
                'emails.admin.contactFormSubmitted',
                $event->formResponse->toArray()
            );
        });
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(UserWasCreated::class, [$this, 'userWasCreated']);
        $events->listen(ContactFormWasSubmitted::class, [$this, 'contactFormWasSubmitted']);
    }
}
