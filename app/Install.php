<?php

namespace App;

use MadWeb\Initializer\Contracts\Runner;
use MadWeb\Initializer\Jobs\MakeCronTask;
use Laravel\Horizon\HorizonServiceProvider;
use MadWeb\Initializer\Jobs\Supervisor\MakeQueueSupervisorConfig;

class Install
{
    public function production(Runner $run)
    {
        return $run
            ->external('composer', 'install', '--no-dev', '--prefer-dist', '--optimize-autoloader', '-q')
            ->artisan('key:generate')
            ->artisan('migrate', ['--force' => true])
            ->dispatch(new MakeCronTask)
            ->external('yarn', 'install', '--production')
            ->external('yarn', 'run', 'production')
            ->publish([
                HorizonServiceProvider::class => 'horizon-assets',
            ])
            ->artisan('route:cache')
            ->artisan('config:cache')
            ->artisan('view:cache');
    }

    public function productionRoot(Runner $run)
    {
        return $this->localRoot($run);
    }

    public function local(Runner $run)
    {
        return $run
            ->external('composer', 'install')
            ->artisan('key:generate')
            ->artisan('migrate', ['--seed' => true])
            ->dispatch(new MakeCronTask)
            ->external('yarn', 'install')
            ->external('yarn', 'run', 'dev')
            ->publish([
                HorizonServiceProvider::class => 'horizon-assets',
            ]);
    }

    public function localRoot(Runner $run)
    {
        return $run
            ->dispatch(new MakeQueueSupervisorConfig([
                'command' => 'php artisan horizon',
            ]))
            ->external('supervisorctl', 'reread')
            ->external('supervisorctl', 'update');
    }
}
