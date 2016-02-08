<?php

namespace Services\Auth;

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
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $last_activity
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
abstract class BaseUser extends Model implements AuthenticatableContract, CanResetPasswordContract, AuthorizableContract
{
    use Authenticatable, CanResetPassword, Presentable, Authorizable;

    protected $guarded = ['id'];
    protected $hidden = ['password', 'remember_token'];
    protected $dates = ['last_activity'];

    abstract public function getHomeUrl() : string;
    abstract public function getProfileUrl() : string;

    public function setPasswordAttribute(string $value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function hasNeverLoggedIn() : bool
    {
        return empty($this->password);
    }

    public function registerLastActivity() : static
    {
        $this->last_activity = Carbon::now();

        return $this;
    }
}
