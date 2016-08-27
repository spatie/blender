<?php

namespace App\Services\Auth\Back\Events;

use App\Events\Event;
use App\Services\Auth\Back\User;

class UserCreated extends Event
{
    /** @var \App\Services\Auth\Back\User */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
