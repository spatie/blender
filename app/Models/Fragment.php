<?php

namespace App\Models;

use App\Foundation\Models\Base\TranslatableEloquent;
use App\Foundation\Models\Traits\Presentable;

class Fragment extends TranslatableEloquent
{
    use Presentable;

    protected $guarded = ['id'];
    protected $with = ['name'];

    public $translatedAttributes = ['text'];

    public static function findByName(string $name) : Fragment
    {
        return app('cache')->rememberForever("fragment.findByName.{$name}", function () use ($name) : Fragment {
            return static::where('name', $name)->first();
        });
    }
}
