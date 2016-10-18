<?php

namespace App\Services\Auth\Front\Enums;

use App\Foundation\Enums\Enum;

/**
 * @method static ACTIVE()
 * @method static WAITING_FOR_APPROVAL()
 */
class UserStatus extends Enum
{
    const ACTIVE = 'active';
    const WAITING_FOR_APPROVAL = 'waiting_for_approval';
}
