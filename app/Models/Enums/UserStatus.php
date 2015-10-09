<?php

namespace App\Models\Enums;

use MyCLabs\Enum\Enum;

class UserStatus extends Enum
{
    const ACTIVE = 'active';
    const WAITING_FOR_APPROVAL = 'waiting for approval';
}
