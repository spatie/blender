<?php

namespace App\Models;

use App\Foundation\Models\Base\TranslatableEloquent;
use App\Foundation\Models\Traits\Presentable;

class Fragment extends TranslatableEloquent
{
    use Presentable;

    protected $with = ['translations'];

    public $translatedAttributes = ['text'];

    /**
     * @return \App\Models\Fragment|null
     */
    public static function findByName(string $name)
    {
        return app('cache')->rememberForever("fragment.findByName.{$name}", function () use ($name) {
            return static::where('name', $name)->first();
        });
    }

    public static function getGroup(string $group, string $locale) : array
    {
        return static::query()
            ->where('name', 'LIKE', "{$group}.%")
            ->get()
            ->map(function (Fragment $fragment) use ($locale, $group) {
                return [
                    'key' => preg_replace("/{$group}\\./", '', $fragment->name, 1),
                    'text' => $fragment->translate($locale)->text,
                ];
            })
            ->pluck('text', 'key')
            ->toArray();
    }
}
