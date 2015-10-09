<?php

namespace App\Services;

use ReflectionClass;

abstract class EventHandler
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     *
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('*', static::class.'@handleAll');
    }

    /**
     * Handle the event.
     *
     * @param $event
     *
     * @return mixed
     */
    public function handleAll($event)
    {
        if (is_array($event)) {
            return;
        }
        if (!is_object($event) && !class_exists($event)) {
            return;
        }

        $eventName = $this->getEventName($event);

        if ($this->listenerIsRegistered($eventName)) {
            return call_user_func([$this, 'when'.$eventName], $event);
        }
    }

    /**
     * Figure out what the name of the class is.
     *
     * @param $event
     *
     * @return string
     */
    protected function getEventName($event)
    {
        return (new ReflectionClass($event))->getShortName();
    }

    /**
     * Determine if a method in the subclass is registered
     * for this particular event.
     *
     * @param $eventName
     *
     * @return bool
     */
    protected function listenerIsRegistered($eventName)
    {
        $method = "when{$eventName}";

        return method_exists($this, $method);
    }
}
