<?php

namespace App\Models;

use App\Foundation\Models\Traits\Presentable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Fragment extends Model
{
    use HasTranslations, Presentable, LogsActivity;

    public $translatable = ['text'];

    protected static $logAttributes = ['name', 'text'];

    protected static $recordEvents = ['updated'];

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


    public function getDescriptionForEvent(string $eventName): string
    {
        $link = link_to_action("Back\\FragmentController@edit", $this->name, [$this->id]);

        return "Fragment '{$link}' werd bijgewerkt";
    }
}
