<?php

namespace App\Providers;

use Exception;
use Illuminate\Cache\MemcachedConnector;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->configureEmailRecipients();
    }

    protected function configureEmailRecipients()
    {
        if (app()->environment('production')) {
            return;
        }

        config()->set('mail.recipients', ['technical@spatie.be']);
    }
}
