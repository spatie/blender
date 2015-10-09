<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\MemcachedConnector;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Overwrite any vendor / package configuration.
     *
     * This service provider is intended to provide a convenient location for you
     * to overwrite any "vendor" or package configuration that you may want to
     * modify before the application handles the incoming request / command.
     */
    public function register()
    {
        $this->configureCacheProvider();
        $this->configureEmailRecipients();
    }

    /**
     * Set the cache driver to array if memcached is set but not available. Ignored in production.
     */
    protected function configureCacheProvider()
    {
        if (
            app()->environment() === 'production' ||
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

    /**
     * Set the email recipients to technical@spatie.be in non-production environments.
     */
    protected function configureEmailRecipients()
    {
        if (app()->environment() === 'production') {
            return;
        }

        config()->set('mail.questionFormRecipients', ['technical@spatie.be']);
    }
}
