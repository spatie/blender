<?php

namespace App\Services\Auth\Back;

use App\Services\Auth\Back\Enums\UserRole;
use App\Services\Auth\Back\Enums\UserStatus;
use App\Services\Auth\Back\Exceptions\UserIsAlreadyActivated;
use App\Services\Auth\Back\Mail\ResetPassword;
use App\Services\Auth\User as BaseUser;
use Illuminate\Support\Facades\Mail;

/**
 * @property \App\Services\Auth\Back\Enums\UserRole $role
 * @property \App\Services\Auth\Back\Enums\UserStatus $status
 */
class User extends BaseUser
{
    protected $table = 'users_back';

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
        return action('Back\AdministratorsController@edit', $this->id);
    }

    public function getStatusAttribute(): UserStatus
    {
        return new UserStatus($this->attributes['status']);
    }

    public function setStatusAttribute(string $status)
    {
        $this->attributes['status'] = $status;
    }

    public function hasStatus(string $status): bool
    {
        return $this->status === $status;
    }

    public function isActive(): bool
    {
        return $this->hasStatus(UserStatus::ACTIVE);
    }

    public function activate(): self
    {
        if ($this->status !== UserStatus::WAITING_FOR_APPROVAL) {
            throw new UserIsAlreadyActivated();
        }

        $this->status = UserStatus::ACTIVE;

        return $this;
    }

    public function getRoleAttribute(): string
    {
        return $this->attributes['role'];
    }

    public function setRoleAttribute(string $role)
    {
        $this->attributes['role'] = $role;
    }

    public function hasRole(UserRole $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        Mail::to($this->email)->send(new ResetPassword($this, $token));
    }

    public function delete()
    {
        if (current_user() && current_user()->id === $this->id) {
            abort(406);
        }

        return parent::delete();
    }
}
