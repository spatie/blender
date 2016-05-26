<?php

namespace App\Services\Auth;

use App\Foundation\Models\Traits\Presentable;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * @property int $id
 * @property string $email
 * @property string $password
 * @property int $first_name
 * @property int $last_name
 * @property string $remember_token
 * @property string $locale
 * @property \Carbon\Carbon $last_activity
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
abstract class User extends Model implements AuthenticatableContract, CanResetPasswordContract, AuthorizableContract
{
    use Authenticatable, CanResetPassword, Presentable, Authorizable;

    protected $guarded = ['id'];
    protected $hidden = ['password', 'remember_token'];
    protected $dates = ['last_activity'];

    abstract public function guardDriver():string;
    abstract public function getHomeUrl():string;
    abstract public function getProfileUrl():string;

    public function setPasswordAttribute(string $value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function hasNeverLoggedIn():bool
    {
        return empty($this->password);
    }

    public function registerLastActivity():User
    {
        $this->last_activity = Carbon::now();

        return $this;
    }

    public function isCurrentUser():bool
    {
        if (!$this->id) {
            return false;
        }

        if ($this->guardDriver() !== config('auth.defaults.guard')) {
            return false;
        }

        return $this->id === auth()->id();
    }

    /**
     * @param string $token
     *
     * @return \App\Services\Auth\User|null
     */
    public static function findByToken(string $token)
    {
        $resetRecord = app('db')->table('password_resets')->where('token', $token)->first();

        if (empty($resetRecord)) {
            return;
        }

        return static::where('email', $resetRecord->email)->first();
    }

    /**
     * @param string $email
     *
     * @return \App\Services\Auth\User|null
     */
    public static function findByEmail(string $email)
    {
        return static::where('email', $email)->first();
    }
}
