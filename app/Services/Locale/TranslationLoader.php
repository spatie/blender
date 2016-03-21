<?php

namespace App\Services\Locale;

use App\Models\Fragment;
use Cache;
use Illuminate\Translation\FileLoader;
use Schema;

class TranslationLoader extends FileLoader
{
    /**
     * Load the messages for the given locale.
     *
     * @param  string $locale
     * @param  string $group
     * @param  string $namespace
     *
     * @return array
     */
    public function load($locale, $group, $namespace = null) : array
    {
        if (!is_null($namespace) && $namespace !== '*') {
            return $this->loadNamespaced($locale, $group, $namespace);
        }

        if (!Schema::hasTable('fragments')) {
            return [];
        }

        return Cache::rememberForever("locale.fragments.{$locale}.{$group}", function () use ($group, $locale) {
            return $this->fetchFragments($group, $locale);
        });
    }

    protected function fetchFragments(string $group, string $locale) : array
    {
        return Fragment::query()
            ->where('name', 'LIKE', "{$group}.%")
            ->get()
            ->map(function (Fragment $fragment) use ($locale, $group) {
                return [
                    'key' => str_replace("{$group}.", '', $fragment->name),
                    'text' => $fragment->translate($locale)->text,
                ];
            })
            ->pluck('text', 'key')
            ->toArray();
    }
}
