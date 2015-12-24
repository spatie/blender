<?php

namespace App\Models;

use App\Events\UserWasActivated;
use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;
use App\Foundation\Models\Traits\Presentable;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Event;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, AuthorizableContract
{
    use Authenticatable, CanResetPassword, Presentable, Authorizable;

    protected $guarded = ['id'];
    protected $hidden = ['password', 'remember_token'];
    protected $dates = ['last_activity'];

    /**
     * When we set the password, make sure to run it through bcrypt.
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Determine if this user has never logged in.
     *
     * @return bool
     */
    public function hasNeverLoggedIn()
    {
        return $this->password == '';
    }

    /**
     * Set the last activity to now.
     */
    public function setLastActivityToNow()
    {
        $this->last_activity = new Carbon();
        $this->save();
    }

    /**
     * Check wether this is the currently logged in user.
     *
     * @return bool
     */
    public function isCurrentUser()
    {
        return ($this->id === auth()->id());
    }

    public function hasRole($role)
    {
        if (!UserRole::isValid($role)) {
            throw new \Exception("{$role} is not a valid role");
        }

        return $this->role == $role;
    }

    public function hasStatus($status)
    {
        if (!UserStatus::isValid($status)) {
            throw new \Exception("{$status} is not a valid role");
        }

        return $this->status == $status;
    }

    /**
     * Return the url to where the user must be redirected after log in.
     *
     * @return string
     *
     * @throws Exception
     */
    public function getHomeUrl()
    {
        if ($this->can('viewBacksite')) {
            return route('dashboard');
        }

        return '/';
    }

    /**
     * Return the url to where the user must be redirected when clicking
     * the email address in the navigation.
     *
     * @return string
     *
     * @throws \Exception
     */
    public function getProfileUrl()
    {
        if ($this->hasRole(UserRole::ADMIN)) {
            return action('Back\UserController@edit', [$this->id]);
        }

        throw new \Exception('Could not determine profile url');
    }

    /**
     * Activate a user.
     *
     * @throws Exception
     */
    public function activate()
    {
        if ($this->status != UserStatus::WAITING_FOR_APPROVAL) {
            throw new Exception('Could not activate user');
        }
        $this->status = UserStatus::ACTIVE;
        $this->save();

        Event::fire(new UserWasActivated($this));
    }
}
