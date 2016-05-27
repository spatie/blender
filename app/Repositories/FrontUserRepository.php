<?php

namespace App\Repositories;

use App\Foundation\Repositories\Repository;
use App\Services\Auth\Front\Enums\UserRole;
use App\Services\Auth\Front\Enums\UserStatus;
use App\Services\Auth\Front\User;
use Illuminate\Support\Collection;

interface FrontUserRepository extends Repository
{
    const MODEL = User::class;

    public function getAllWithRole(UserRole $role):Collection;
    public function getAllWithRoleAndStatus(UserRole $role, UserStatus $status):Collection;
}
