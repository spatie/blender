<?php

namespace App\Models\Foundation\Base;

use App\Models\Foundation\Traits\Draftable;
use App\Models\Foundation\Traits\Presentable;
use App\Models\Foundation\Traits\HasMedia as HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

abstract class ModuleModel extends TranslatableEloquent implements HasMediaConversions
{
    use Draftable, Presentable, HasMediaTrait;

    /**
     * @var array
     */
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
}
