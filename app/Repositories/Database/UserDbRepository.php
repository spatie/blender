<?php

namespace App\Repositories\Database;

use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;
use App\Models\User;
use App\Repositories\UserRepository;
use DB;
use Illuminate\Database\Eloquent\Model;

class UserDbRepository extends DbRepository implements UserRepository
{
    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * Find user by the given token.
     *
     * @param string $token
     *
     * @return mixed
     */
    public function findByToken($token)
    {
        $rawUser = DB::table(config('auth.password.table'))->where('token', $token)->first();

        if (!$rawUser) {
            return $rawUser;
        }

        return $this->model->where('email', $rawUser->email)->first();
    }

    /**
     * Delete the model.
     *
     * @param \Illuminate\Database\Eloquent\Model $user
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function delete(Model $user)
    {
        if (auth()->user() && auth()->user()->id === $user->id) {
            abort(406);
        }

        return $user->delete();
    }

    /**
     * Get all users with the given role.
     *
     * @param string $role
     *
     * @return mixed
     */
    public function getAllWithRole($role)
    {
        return $this->model
            ->where('role', $role)
            ->get();
    }

    /**
     * @param UserRole   $role
     * @param UserStatus $status
     *
     * @return mixed
     */
    public function getAllWithRoleAndStatus(UserRole $role, UserStatus $status)
    {
        return $this->model
            ->where('role', $role)
            ->where('status', $status)
            ->get();
    }
}
