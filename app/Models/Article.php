<?php

namespace App\Models;

use App\Models\Enums\SpecialArticle;
use App\Models\Presenters\ArticlePresenter;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Spatie\Blender\Model\Model;
use Spatie\Blender\Model\Traits\HasSlug;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @property \App\Models\Article $parent
 * @property \Illuminate\Support\Collection $children
 * @property \App\Models\Article $firstChild
 * @property \Illuminate\Support\Collection $siblings
 */
class Article extends Model implements Sortable
{
    use ArticlePresenter, HasSlug, SortableTrait;

    protected $with = ['media'];

    public $mediaLibraryCollections = ['images', 'downloads'];
    public $translatable = ['name', 'text', 'slug', 'seo_values'];

    public function registerMediaConversions()
    {
        parent::registerMediaConversions();

        $this->addMediaConversion('thumb')
            ->setWidth(368)
            ->setHeight(232)
            ->performOnCollections('images');
    }

    public function isSpecialArticle(): bool
    {
        return ! empty($this->technical_name);
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('order_column');
    }

    public function hasChildren(): bool
    {
        return count($this->children);
    }

    public function getFirstChildAttribute(): Article
    {
        if (! $this->hasChildren()) {
            throw new Exception("Article `{$this->id}` doesn't have any children.");
        }

        return $this->children->sortBy('order_column')->first();
    }

    public function getSiblingsAttribute(): Collection
    {
        return self::where('parent_id', $this->parent_id)
            ->orderBy('order_column')
            ->get();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function hasParent(): bool
    {
        return ! is_null($this->parent);
    }

    public function getFullUrlAttribute(): string
    {
        $localeSegment = '';

        if (locales()->count() > 1) {
            $localeSegment = '/'.locale();
        }

        if ($this->technical_name === SpecialArticle::HOME) {
            return $localeSegment;
        }

        $parentUrl = $this->hasParent() ? $this->parent->url.'/' : '';

        return "{$localeSegment}/{$parentUrl}{$this->url}";
    }
}
