<?php

namespace App\Services\Auth\Front;

use App\Services\Auth\Front\Enums\UserRole;
use App\Services\Auth\Front\Enums\UserStatus;
use App\Services\Auth\Front\Events\UserWasRegistered;
use App\Services\Auth\Front\Exceptions\UserIsAlreadyActivated;
use App\Services\Auth\Front\Mail\ResetPassword;
use App\Services\Auth\User as BaseUser;
use Mail;

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
    protected $presenter = UserPresenter::class;

    public static function register(array $input): User
    {
        $defaults = [
            'role' => UserRole::MEMBER(),
            'status' => UserStatus::ACTIVE(),
        ];

        $user = static::create($defaults + array_only($input, [
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

        event(new UserWasRegistered($user));

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

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        Mail::to($this->email)->send(new ResetPassword($this, $token));
    }
}
