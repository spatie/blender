<?php

namespace App\Services\Auth\Back\Events;

use App\Events\Event;
use App\Models\Administrator;

class UserCreated extends Event
{
    /** @var \App\Models\Administrator */
    public $user;

    public function __construct(Administrator $user)
    {
        $this->user = $user;
    }
}
