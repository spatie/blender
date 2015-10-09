<?php

namespace App\Listeners;

use App\Events\UserWasCreated;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPasswordEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var \Illuminate\Contracts\Auth\PasswordBroker
     */
    protected $passwords;

    /**
     * @param \Illuminate\Contracts\Auth\PasswordBroker $passwords
     */
    public function __construct(PasswordBroker $passwords)
    {
        $this->passwords = $passwords;
    }

    /**
     * @param \App\Events\UserWasCreated $event
     */
    public function handle(UserWasCreated $event)
    {
        $this->passwords->sendResetLink(['email' => $event->user->email], function ($message) use ($event) {
            $message->subject(trans('passwords.subjectEmailNewUser', [], $event->user->locale));
        });
    }
}
