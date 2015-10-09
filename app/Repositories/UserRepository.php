<?php

namespace App\Repositories;

use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;
use Illuminate\Database\Eloquent\Collection;

interface UserRepository extends Repository
{
    /**
     * Find user by the given token.
     *
     * @param string $token
     *
     * @return mixed
     */
    public function findByToken($token);

    /**
     * Get all users with the given role.
     *
     * @param  $role
     *
     * @return Collection
     */
    public function getAllWithRole($role);

    /**
     * Get all users with the given role and status.
     *
     * @param UserRole   $role
     * @param UserStatus $status
     *
     * @return Collection
     */
    public function getAllWithRoleAndStatus(UserRole $role, UserStatus $status);
}
