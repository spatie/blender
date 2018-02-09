<?php

namespace App\Services\Auth\Back\Events;

use App\Events\Event;
use App\Models\User;

class UserActivated extends Event
{
    /** @var \App\Models\User */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
