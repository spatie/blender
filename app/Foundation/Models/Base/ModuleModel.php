<?php

namespace App\Foundation\Models\Base;

use App\Foundation\Models\Traits\Draftable;
use App\Foundation\Models\Traits\HasSeoValues;
use App\Foundation\Models\Traits\HasMedia as HasMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\ModelCleanup\GetsCleanedUp;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Spatie\Translatable\HasTranslations;

abstract class ModuleModel extends Model implements HasMediaConversions, GetsCleanedUp
{
    use Draftable, HasMediaTrait, HasSeoValues, HasTranslations;

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

    public function defaultSeoValues(): array
    {
        return [
            'title' => $this->name,
            'meta_title' => $this->name,
            'meta_description' => (string) string($this->text)->tease(155),
            'meta_og:title' => $this->name,
            'meta_og:type' => 'website',
            'meta_og:description' => (string) string($this->text)->tease(155),
            'meta_og:image' => $this->hasMedia('images') ?
                url($this->getFirstMediaUrl('images')) :
                url('/images/og-image.png'),
        ];
    }
}
