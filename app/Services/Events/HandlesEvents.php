<?php

namespace App\Services\Events;

use Illuminate\Contracts\Events\Dispatcher;
use ReflectionClass;

trait HandlesEvents
{
    protected $events = [];

    public function subscribe(Dispatcher $dispatcher)
    {
        collect($this->events)->each(function (string $event) use ($dispatcher) {
            $dispatcher->listen(
                $event,
                static::class . '@' . (new ReflectionClass($event))->getShortName()
            );
        });
    }
}
