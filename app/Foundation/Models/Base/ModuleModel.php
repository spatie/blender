<?php

namespace App\Foundation\Models\Base;

use App\Foundation\Models\Traits\Draftable;
use App\Foundation\Models\Traits\Presentable;
use App\Foundation\Models\Traits\HasMedia as HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

abstract class ModuleModel extends TranslatableEloquent implements HasMediaConversions
{
    use Draftable, Presentable, HasMediaTrait;

    protected $guarded = ['id'];
    protected $with = ['media', 'translations'];

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
}
