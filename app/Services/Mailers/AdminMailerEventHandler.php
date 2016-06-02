<?php

namespace App\Services\Mailers;

use App\Events\ContactFormWasSubmitted;
use App\Services\Auth\Front\Events\UserWasActivated;
use App\Services\Auth\Back\Events\UserWasCreated;
use Illuminate\Contracts\Events\Dispatcher;

class AdminMailerEventHandler
{
    use SendsMails;
    
    public function whenUserWasCreated(UserWasCreated $event)
    {
        Password::broker('back')->sendResetLink(['email' => $event->user->email], function (Message $message) {
            $message->subject(fragment('passwords.subjectEmailNewUser'));
        });
    }

    public function whenContactFormWasSubmitted(ContactFormWasSubmitted $event)
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

    public function whenUserWasActivated(UserWasActivated $event)
    {
        collect([])->each(function (string $email) use ($event) {
            $this->sendMail(
                $email,
                'Een nieuwe gebruiker heeft zich geregistreerd',
                'emails.admin.userApproval',
                ['userId' => $event->user->id]
            );
        });
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(UserWasCreated::class, [$this, 'whenUserWasCreated']);
        $events->listen(ContactFormWasSubmitted::class, [$this, 'whenContactFormWasSubmitted']);
    }
}
