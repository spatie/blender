<?php

namespace App\Providers;

use App\Repositories\Cache\Subscriber as CacheSubscriber;
use App\Services\Navigation\CurrentSection;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Cache;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $dbRepositories = [
        'Activity',
        'Event',
        'NewsItem',
        'Person',
        'Tag',
        'User',
    ];

    /**
     * @var array
     */
    protected $cacheRepositories = [
        'Article',
        'Fragment',
    ];

    /**
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     */
    public function boot(Dispatcher $events)
    {
        foreach ($this->cacheRepositories as $repositoryName) {
            $events->listen(
                "eloquent.saved: App\\Models\\{$repositoryName}",
                function() {Cache::flush();}
            );
        }
    }



    /**
     * Register any application services.
     */
    public function register()
    {
        // Don't use cache repositories in the back end
        if ($this->app->make(CurrentSection::class)->determine() === 'blender') {
            $this->dbRepositories = array_merge($this->dbRepositories, $this->cacheRepositories);
            $this->cacheRepositories = [];
        }

        foreach ($this->cacheRepositories as $cacheRepository) {
            $this->app->singleton(
                "App\\Repositories\\{$cacheRepository}Repository",
                "App\\Repositories\\Cache\\{$cacheRepository}CacheRepository"
            );
        }

        foreach ($this->dbRepositories as $dbRepository) {
            $this->app->singleton(
                "App\\Repositories\\{$dbRepository}Repository",
                "App\\Repositories\\Database\\{$dbRepository}DbRepository"
            );
        }
    }
}
