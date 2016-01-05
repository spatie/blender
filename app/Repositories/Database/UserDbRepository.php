<?php

namespace App\Repositories\Database;

use App\Foundation\Repositories\DbRepository;
use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;
use App\Repositories\UserRepository;
use Illuminate\Database\Connection as Database;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserDbRepository extends DbRepository implements UserRepository
{
    /**
     * @return \App\Models\User|null
     */
    public function findByToken(string $token)
    {
        $userInfo = app(Database::class)
            ->table(config('auth.password.table'))
            ->where('token', $token)
            ->first();

        if (!$userInfo) {
            return;
        }

        return $this->query()
            ->where('email', $userInfo->email)
            ->first();
    }

    public function getAllWithRole(UserRole $role) : Collection
    {
        return $this->query()
            ->where('role', $role)
            ->get();
    }

    public function getAllWithRoleAndStatus(UserRole $role, UserStatus $status) : Collection
    {
        return $this->query()
            ->where('role', $role)
            ->where('status', $status)
            ->get();
    }

    public function delete(Model $user) : bool
    {
        if (auth()->user() && auth()->user()->id === $user->id) {
            abort(406);
        }

        return parent::delete($user);
    }
}
