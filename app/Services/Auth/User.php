<?php

namespace App\Services\Auth;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $name
 * @property string $remember_token
 * @property string $locale
 * @property \Carbon\Carbon $last_activity
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
abstract class User extends Model implements AuthenticatableContract, CanResetPasswordContract, AuthorizableContract
{
    use Authenticatable, CanResetPassword, Authorizable, Notifiable, UserPresenter;

    protected $guarded = ['id'];
    protected $hidden = ['password', 'remember_token'];
    protected $dates = ['last_activity'];

    abstract public function guardDriver(): string;

    abstract public function getHomeUrl(): string;

    abstract public function getProfileUrl(): string;

    public function getNameAttribute(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function hasNeverLoggedIn(): bool
    {
        return empty($this->password);
    }

    public function registerLastActivity(): self
    {
        $this->last_activity = Carbon::now();

        return $this;
    }

    public function isCurrentUser(): bool
    {
        if (! $this->id) {
            return false;
        }

        if ($this->guardDriver() !== config('auth.defaults.guard')) {
            return false;
        }

        return $this->id === auth()->id();
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
