<?php

namespace App\Services\Auth\Back;

use App\Services\Auth\Back\Enums\UserRole;
use App\Services\Auth\Back\Enums\UserStatus;
use App\Services\Auth\Back\Exceptions\UserIsAlreadyActivated;
use App\Services\Auth\User as BaseUser;

/**
 * @property \App\Services\Auth\Back\Enums\UserRole $role
 * @property \App\Services\Auth\Back\Enums\UserStatus $status
 */
class User extends BaseUser
{
    protected $table = 'users_back';
    protected $presenter = UserPresenter::class;

    public function guardDriver(): string
    {
        return 'back';
    }

    public function getHomeUrl(): string
    {
        return url('blender');
    }

    public function getProfileUrl(): string
    {
        return action('Back\BackUserController@edit', ['id' => $this->id]);
    }

    public function getStatusAttribute(): UserStatus
    {
        return new UserStatus($this->attributes['status']);
    }

    public function setStatusAttribute(UserStatus $status)
    {
        $this->attributes['status'] = $status->getValue();
    }

    public function hasStatus(UserStatus $status): bool
    {
        return $this->status->equals($status);
    }

    public function isActive(): bool
    {
        return $this->hasStatus(UserStatus::ACTIVE());
    }

    public function activate(): User
    {
        if ($this->status->doesntEqual(UserStatus::WAITING_FOR_APPROVAL())) {
            throw new UserIsAlreadyActivated();
        }

        $this->status = UserStatus::ACTIVE();

        return $this;
    }

    public function getRoleAttribute(): UserRole
    {
        return new UserRole($this->attributes['role']);
    }

    public function setRoleAttribute(UserRole $role)
    {
        $this->attributes['role'] = $role->getValue();
    }

    public function hasRole(UserRole $role): bool
    {
        return $this->role->equals($role);
    }
}
