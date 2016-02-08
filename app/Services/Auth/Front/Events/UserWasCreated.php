<?php

namespace Services\Auth\Front\Events;

use App\Events\Event;
use App\Services\Auth\Front\User;

class UserWasCreated extends Event
{
    /** @var \App\Services\Auth\Front\User */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
