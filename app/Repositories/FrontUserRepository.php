<?php

namespace App\Repositories;

use App\Foundation\Repositories\Repository;
use App\Services\Auth\Front\Enums\UserRole;
use App\Services\Auth\Front\Enums\UserStatus;
use App\Services\Auth\Front\User;
use Illuminate\Support\Collection;

class FrontUserRepository extends Repository
{
    const MODEL = User::class;

    public function getAllWithRole(UserRole $role): Collection
    {
        return $this->query()
            ->where('role', $role)
            ->get();
    }

    public function getAllWithRoleAndStatus(UserRole $role, UserStatus $status): Collection
    {
        return $this->query()
            ->where('role', $role)
            ->where('status', $status)
            ->get();
    }
}
