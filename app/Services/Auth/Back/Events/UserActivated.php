<?php

namespace App\Services\Auth\Back\Events;

use App\Events\Event;
use App\Services\Auth\Front\User;

class UserActivated extends Event
{
    /** @var \App\Services\Auth\Front\User */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
