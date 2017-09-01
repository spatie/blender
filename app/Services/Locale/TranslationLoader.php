<?php

namespace App\Services\Locale;

use App\Models\Fragment;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Translation\FileLoader;

class TranslationLoader extends FileLoader
{
    /**
     * Load the messages for the given locale.
     *
     * @param string $locale
     * @param string $group
     * @param string $namespace
     *
     * @return array
     */
    public function load($locale, $group, $namespace = null): array
    {
        if (! is_null($namespace) && $namespace !== '*') {
            return $this->loadNamespaced($locale, $group, $namespace);
        }

        if (! $this->fragmentsAreAvailable()) {
            return [];
        }

        return Cache::rememberForever(
            "locale.fragments.{$locale}.{$group}",
            function () use ($group, $locale) {
                return Fragment::getGroup($group, $locale);
            }
        );
    }

    protected function fragmentsAreAvailable(): bool
    {
        static $fragmentTableFound = null;

        if (is_null($fragmentTableFound)) {
            try {
                $fragmentTableFound = Schema::hasTable('fragments');
            } catch (\Exception $e) {
                $fragmentTableFound = false;
            }
        }

        return $fragmentTableFound;
    }
}
