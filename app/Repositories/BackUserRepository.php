<?php

namespace App\Repositories;

use App\Foundation\Repositories\Repository;
use App\Services\Auth\Back\Enums\UserRole;
use App\Services\Auth\Back\Enums\UserStatus;
use App\Services\Auth\Back\User;
use Illuminate\Support\Collection;

interface BackUserRepository extends Repository
{
    const MODEL = User::class;

    public function getAllWithRole(UserRole $role) : Collection;
    public function getAllWithRoleAndStatus(UserRole $role, UserStatus $status) : Collection;
}
