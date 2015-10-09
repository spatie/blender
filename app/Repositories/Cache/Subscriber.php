<?php

namespace App\Repositories\Cache;

use App\Models\Article;
use App\Models\Fragment;

class Subscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     *
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen(
            'eloquent.saved: '.Article::class,
            ArticleCacheRepository::class.'@flush'
        );

        $events->listen(
            'eloquent.saved: '.Fragment::class,
            FragmentCacheRepository::class.'@flush'
        );
    }
}
