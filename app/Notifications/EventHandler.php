<?php

namespace App\Notifications;

use App\Services\Auth\Back\Events\UserWasCreated;
use Illuminate\Contracts\Events\Dispatcher;

class EventHandler
{
    /**
     * @param \App\Notifications\Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(UserWasCreated::class, [$this, 'userWasCreated']);
        $events->listen(ContactFormSubmitted::class, [$this, 'contactFormWasSubmitted']);
    }
}
