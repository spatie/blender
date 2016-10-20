<?php

namespace App\Test\Integration\Back;

use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;
use App\Models\User;
use Spatie\Integration\BackTestCase as BaseBackTestCase;

class BackTestCase extends BaseBackTestCase
{
    public function currentUser()
    {
        return factory(User::class)->create([
            'role'   => UserRole::ADMIN,
            'status' => UserStatus::ACTIVE,
        ]);
    }
}
