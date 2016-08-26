<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    public function boot(Dispatcher $events)
    {
        $events->subscribe(\App\Notifications\Eventhandler::class);
        $events->subscribe(\App\Mail\Eventhandler::class);
    }
}
