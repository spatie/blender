<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as IlluminateEventServiceProvider;

class EventServiceProvider extends IlluminateEventServiceProvider
{
    protected $listen = [];

    protected $subscribe = [
        \App\Notifications\Eventhandler::class,
        \App\Mail\Eventhandler::class,
    ];
}
