<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as IlluminateEventServiceProvider;

class EventServiceProvider extends IlluminateEventServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    public function subscribe($events)
    {
        $events->subscribe(\App\Notifications\Eventhandler::class);
        $events->subscribe(\App\Mail\Eventhandler::class);
    }
}
