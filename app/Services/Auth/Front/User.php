<?php

namespace App\Services\Auth\Front;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Services\Auth\User as BaseUser;
use App\Services\Auth\Front\Enums\UserRole;
use App\Services\Auth\Front\Enums\UserStatus;
use App\Services\Auth\Front\Mail\ResetPassword;
use App\Services\Auth\Front\Events\UserRegistered;
use App\Services\Auth\Front\Exceptions\UserIsAlreadyActivated;

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

    public static function register(array $input): self
    {
        $defaults = [
            'role' => UserRole::MEMBER,
            'status' => UserStatus::ACTIVE,
        ];

        $user = static::create($defaults + Arr::only($input, [
            'first_name',
            'last_name',
            'address',
            'postal',
            'city',
            'country',
            'telephone',
            'email',
            'password',
        ]));

        event(new UserRegistered($user));

        return $user;
    }

    public function guardDriver(): string
    {
        return 'front';
    }

    public function getHomeUrl(): string
    {
        return url('/');
    }

    public function getProfileUrl(): string
    {
        return url('/');
    }

    public function getStatusAttribute(): string
    {
        return $this->attributes['status'];
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

    public function hasRole($role): bool
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
}
