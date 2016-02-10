<?php

namespace App\Services\Auth\Front;

use App\Services\Auth\Front\Enums\UserRole;
use App\Services\Auth\Front\Enums\UserStatus;
use App\Services\Auth\Front\Exceptions\UserIsAlreadyActivated;
use App\Services\Auth\User as BaseUser;

/**
 * @property string $address
 * @property string $postal
 * @property string $city
 * @property string $country
 * @property string $telephone
 * @property \App\Services\Auth\Front\Enums\UserRole $role
 * @property \App\Services\Auth\Front\Enums\UserStatus $status
 */
class User extends BaseUser
{
    protected $table = 'users_front';

    public function guardDriver() : string
    {
        return 'front';
    }

    public function getHomeUrl() : string
    {
        return url('/');
    }

    public function getProfileUrl() : string
    {
        return url('/');
    }

    public function getStatusAttribute() : UserStatus
    {
        return new UserStatus($this->attributes['status']);
    }

    public function setStatusAttribute(UserStatus $status)
    {
        $this->attributes['status'] = $status->getValue();
    }

    public function hasStatus(UserStatus $status) : bool
    {
        return $this->status->equals($status);
    }

    public function activate() : User
    {
        if ($this->status->doesntEqual(UserStatus::WAITING_FOR_APPROVAL())) {
            throw new UserIsAlreadyActivated();
        }

        $this->status = UserStatus::ACTIVE();

        return $this;
    }

    public function getRoleAttribute() : UserRole
    {
        return new UserRole($this->attributes['role']);
    }

    public function setRoleAttribute(UserRole $role)
    {
        $this->attributes['role'] = $role->getValue();
    }

    public function hasRole(UserRole $role) : bool
    {
        return $this->role->equals($role);
    }
}
