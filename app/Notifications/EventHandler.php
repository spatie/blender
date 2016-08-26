<?php

namespace App\Notifications;

use App\Services\Auth\Back\Events\UserCreated;
use Illuminate\Contracts\Events\Dispatcher;

class EventHandler
{
    /** @param \App\Notifications\Dispatcher $events */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(UserCreated::class, [$this, 'userCreated']);
    }
}
