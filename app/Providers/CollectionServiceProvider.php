<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class CollectionServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Collection::macro('pipe', function ($callback) {
            return $callback($this);
        });

        Collection::macro('dd', function () {
            dd($this);
        });

        Collection::macro('ifEmpty', function ($callback) {
            if ($this->empty()) {
                $callback();
            }
            return $this;
        });

        Collection::macro('ifAny', function ($callback) {
            if (! $this->empty()) {
                $callback($this);
            }
            return $this;
        });
        
        Collection::macro('range', function ($low, $high, $step = 1): Collection {
            return new Collection(range($low, $high, $step));
        });
    }
}
