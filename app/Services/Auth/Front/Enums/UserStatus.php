<?php

namespace App\Services\Auth\Front\Enums;

use App\Foundation\Models\Enums\Enum;

class UserStatus extends Enum
{
    const ACTIVE = 'active';
    const WAITING_FOR_APPROVAL = 'waiting_for_approval';
}
