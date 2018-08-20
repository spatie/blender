<?php

namespace App\Models;

use App\Models\Scopes\NonDraftScope;
use App\Models\Scopes\OnlineScope;
use App\Models\Scopes\SortableScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;
use Spatie\ModelCleanup\GetsCleanedUp;
use Spatie\Translatable\HasTranslations;

abstract class Model extends Eloquent implements HasMedia, GetsCleanedUp
{
    use HasTranslations;
    use Traits\Draftable;
    use Traits\HasMedia;
    use Traits\HasMetaValues;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NonDraftScope());
        static::addGlobalScope(new SortableScope());

        if (request()->isFront()) {
            static::addGlobalScope(new OnlineScope());
        }
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('admin')
            ->width(368)
            ->height(232)
            ->optimize()
            ->nonQueued();

        $this->addMediaConversion('redactor')
            ->width(368)
            ->height(232)
            ->optimize()
            ->nonQueued();
    }

    public static function cleanUp(Builder $query): Builder
    {
        return $query
            ->draft()
            ->where('created_at', '<', Carbon::now()->subWeek());
    }

    public function defaultMetaValues(): array
    {
        return [
            'title' => $this->name,
            'description' => (string) string($this->text)->tease(155),
            'og:title' => $this->name,
            'og:type' => 'website',
            'og:description' => (string) string($this->text)->tease(155),
            'og:image' => $this->hasMedia('images') ?
                url($this->getFirstMediaUrl('images')) :
                url('/images/og-image.png'),
        ];
    }
}
