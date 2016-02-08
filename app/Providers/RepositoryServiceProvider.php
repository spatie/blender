<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Cache;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $dbRepositories = [
        'NewsItem',
        'Person',
        'User',
    ];

    protected $cacheRepositories = [];

    public function register()
    {
        $this->unregisterCacheRepositoriesInBlender();
        $this->registerCacheRepositories();
        $this->registerDbRepositories();
    }

    public function boot(Dispatcher $events)
    {
        $this->registerCacheFlushEvents($events);
    }

    protected function unregisterCacheRepositoriesInBlender()
    {
        if ($this->app->runningInConsole()) {
            return;
        }

        if ($this->app->request->isForBack()) {
            $this->dbRepositories = array_merge($this->dbRepositories, $this->cacheRepositories);
            $this->cacheRepositories = [];
        }
    }

    protected function registerCacheRepositories()
    {
        foreach ($this->cacheRepositories as $cacheRepository) {
            $this->app->singleton(
                "App\\Repositories\\{$cacheRepository}Repository",
                "App\\Repositories\\Cache\\{$cacheRepository}CacheRepository"
            );
        }
    }

    protected function registerDbRepositories()
    {
        foreach ($this->dbRepositories as $dbRepository) {
            $this->app->singleton(
                "App\\Repositories\\{$dbRepository}Repository",
                "App\\Repositories\\Database\\{$dbRepository}DbRepository"
            );
        }
    }

    protected function registerCacheFlushEvents(Dispatcher $events)
    {
        foreach ($this->cacheRepositories as $repositoryName) {
            $events->listen(
                "eloquent.saved: App\\Models\\{$repositoryName}",
                function () {Cache::flush();}
            );
        }
    }
}
