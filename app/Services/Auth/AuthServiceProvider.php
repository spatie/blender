<?php

namespace App\Services\Auth;

use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        $gate->before(function ($user, $ability) {

           if (!$user->hasStatus(UserStatus::ACTIVE)) {
               return false;
           };
        });

        $gate->define('login', function ($user) {
            /*
             * We've already checked in the before callback that
             * the user is active.
             */
            return true;
        });

        $gate->define('viewBacksite', function ($user) {
            return $user->hasRole(UserRole::ADMIN);
        });
    }
}
