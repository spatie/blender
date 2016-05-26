<?php

namespace App\Repositories\Database;

use App\Foundation\Repositories\DbRepository;
use App\Repositories\FrontUserRepository;
use App\Services\Auth\Front\Enums\UserRole;
use App\Services\Auth\Front\Enums\UserStatus;
use Illuminate\Support\Collection;

class FrontUserDbRepository extends DbRepository implements FrontUserRepository
{
    public function getAllWithRole(UserRole $role):Collection
    {
        return $this->query()
            ->where('role', $role)
            ->get();
    }

    public function getAllWithRoleAndStatus(UserRole $role, UserStatus $status):Collection
    {
        return $this->query()
            ->where('role', $role)
            ->where('status', $status)
            ->get();
    }
}
