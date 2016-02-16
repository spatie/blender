<?php

namespace App\Services\Auth\Back\Enums;

use App\Foundation\Models\Enums\Enum;

/**
 * @method static ACTIVE()
 * @method static WAITING_FOR_APPROVAL()
 */
class UserStatus extends Enum
{
    const ACTIVE = 'active';
    const WAITING_FOR_APPROVAL = 'waiting_for_approval';
}
