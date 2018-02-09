<?php

namespace App\Services\Auth\Front\Events;

use App\Events\Event;
use App\Models\User;

class UserRegistered extends Event
{
    /** @var \App\Models\User */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
