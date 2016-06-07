<?php

namespace App\Foundation\Models\Base;

use App\Foundation\Models\Traits\Draftable;
use App\Foundation\Models\Traits\Presentable;
use App\Foundation\Models\Traits\HasMedia as HasMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\ModelCleanup\GetsCleanedUp;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Spatie\Translatable\HasTranslations;

abstract class ModuleModel extends Model implements HasMediaConversions, GetsCleanedUp
{
    use Draftable, Presentable, HasMediaTrait, HasTranslations;

    protected $guarded = ['id'];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('admin')
            ->setWidth(368)
            ->setHeight(232)
            ->nonQueued();

        $this->addMediaConversion('redactor')
            ->setWidth(368)
            ->setHeight(232)
            ->nonQueued();
    }

    public static function cleanUp(Builder $query): Builder
    {
        return $query
            ->draft()
            ->where('created_at', '<', Carbon::now()->subWeek());
    }
}
