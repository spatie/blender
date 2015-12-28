<?php

namespace App\Models;

use App\Foundation\Models\Base\TranslatableEloquent;
use App\Foundation\Models\Traits\Presentable;

class Fragment extends TranslatableEloquent
{
    use Presentable;

    protected $guarded = ['id'];

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
}
