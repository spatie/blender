<?php

namespace App\Models;

use App\Mail\Member\ResetPassword;
use App\Services\Auth\Front\Events\UserRegistered;
use App\Services\Auth\Front\Exceptions\UserIsAlreadyActivated;
use App\Services\Auth\User as BaseUser;
use Illuminate\Support\Facades\Mail;

/**
 * @property string $address
 * @property string $postal
 * @property string $city
 * @property string $country
 * @property string $telephone
 * @property string $role
 * @property string $status
 */
class User extends BaseUser
{
    protected $table = 'users_front';

    public static function register(array $input): self
    {
        $defaults = [
            'role' => BaseUser::ROLE_MEMBER,
            'status' => BaseUser::STATUS_ACTIVE,
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

    public function hasStatus(string $status): bool
    {
        return $this->status === $status;
    }

    public function isActive(): bool
    {
        return $this->hasStatus(BaseUser::STATUS_ACTIVE);
    }

    public function activate(): self
    {
        if ($this->status !== BaseUser::STATUS_WAITING_FOR_APPROVAL) {
            throw new UserIsAlreadyActivated();
        }

        $this->status = BaseUser::STATUS_ACTIVE;

        return $this;
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
