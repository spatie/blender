<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\MemcachedConnector;

class ConfigServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->configureAuthorization();
        $this->configureCacheProvider();
        $this->configureEmailRecipients();
    }

    protected function configureAuthorization()
    {
        config()->set(
            'laravel-authorize.login_url',
            request()->isFront() ? 'login' : 'blender/login'
        );
    }

    protected function configureCacheProvider()
    {
        if (
            app()->environment('production') ||
            config()->get('cache.default') !== 'memcached'
        ) {
            return;
        }

        try {
            if (!class_exists('Memcached')) {
                throw new Exception();
            }

            (new MemcachedConnector())->connect(config('cache.stores.memcached.servers'));
        } catch (Exception $e) {
            config()->set('cache.default', 'array');
        }
    }

    protected function configureEmailRecipients()
    {
        if (app()->environment('production')) {
            return;
        }

        config()->set(
            'mail.recipients',
            collect(config('mail.recipients'))->map(function () {
                return 'technical@spatie.be';
            })
        );
    }
}
