<?php

namespace App;

use MadWeb\Initializer\Contracts\Runner;
use Laravel\Horizon\HorizonServiceProvider;

class Update
{
    public function production(Runner $run)
    {
        return $run
            ->external('composer', 'install', '--no-dev', '--prefer-dist', '--optimize-autoloader')
            ->external('yarn', 'install', '--production')
            ->external('yarn', 'run', 'production')
            ->publish([
                HorizonServiceProvider::class => 'horizon-assets',
            ], true)
            ->artisan('route:cache')
            ->artisan('config:cache')
            ->artisan('migrate', ['--force' => true])
            ->artisan('cache:clear')
            ->artisan('view:cache')
            ->artisan('horizon:terminate');
    }

    public function local(Runner $run)
    {
        return $run
            ->external('composer', 'install')
            ->external('yarn', 'install')
            ->external('yarn', 'run', 'dev')
            ->publish([
                HorizonServiceProvider::class => 'horizon-assets',
            ], true)
            ->artisan('migrate')
            ->artisan('cache:clear')
            ->artisan('view:cache')
            ->artisan('horizon:terminate');
    }
}
