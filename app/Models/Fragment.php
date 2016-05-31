<?php

namespace App\Models;

use App\Foundation\Models\Traits\Presentable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fragment extends Model
{
    use HasTranslations, Presentable;

    public $translatable = ['text'];

    /**
     * @return \App\Models\Fragment|null
     */
    public static function findByName(string $name)
    {
        return app('cache')->rememberForever("fragment.findByName.{$name}", function () use ($name) {
            return static::where('name', $name)->first();
        });
    }

    public static function getGroup(string $group, string $locale): array
    {
        return static::query()
            ->where('name', 'LIKE', "{$group}.%")
            ->get()
            ->map(function (Fragment $fragment) use ($locale, $group) {
                return [
                    'key' => preg_replace("/{$group}\\./", '', $fragment->name, 1),
                    'text' => $fragment->translate('text', $locale),
                ];
            })
            ->pluck('text', 'key')
            ->toArray();
    }
}
