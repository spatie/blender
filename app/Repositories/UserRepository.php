<?php

namespace App\Repositories;

use App\Foundation\Repositories\Repository;
use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;
use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepository extends Repository
{
    const MODEL = User::class;

    /** @return \App\Models\User */
    public function findByToken(string $token);

    public function getAllWithRole(UserRole $role) : Collection;

    public function getAllWithRoleAndStatus(UserRole $role, UserStatus $status) : Collection;
}
