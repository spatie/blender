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

        /**
         * Returns true if $callback returns false for every item.
         */
        Collection::macro('none', function (callable $callback = null): bool {
            return !$this->contains($callback);
        });

        /**
         * Returns true if $callback returns true for every item.
         *
         * If $callback is a string regard it as a validation rule.
         */
        Collection::macro('validate', function ($callback): bool {
            if (is_string($callback) || is_array($callback)) {

                $validationRule = $callback;

                $callback = function ($item) use ($validationRule) {
                    return validate($item, $validationRule);
                };
            }

            foreach ($this->items as $item) {
                if (!$callback($item)) {
                    return false;
                }
            }

            return true;
        });
    }
}
