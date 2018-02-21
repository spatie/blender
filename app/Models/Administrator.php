<?php

namespace App\Models;

use App\Mail\Admin\ResetPassword;
use App\Services\Auth\User as BaseUser;
use App\Services\Auth\Back\Exceptions\UserIsAlreadyActivated;
use Illuminate\Support\Facades\Mail;

/**
 * @property string $role
 * @property string $status
 */
class Administrator extends BaseUser
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

    public function delete()
    {
        if (current_user() && current_user()->id === $this->id) {
            abort(406);
        }

        return parent::delete();
    }
}
