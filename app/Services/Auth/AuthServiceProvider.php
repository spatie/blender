<?php

namespace App\Services\Auth;

use App\Services\Navigation\Section;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);
    }

    public function register()
    {
        parent::register();

        $this->registerDefaultAuthDriver();
    }

    protected function registerDefaultAuthDriver()
    {
        auth()->shouldUse(app(Section::class)->section());
    }
}
