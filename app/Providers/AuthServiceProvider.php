<?php

namespace App\Providers;

use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     */
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
