<?php

namespace App\Models;

use Exception;
use App\Models\Traits\HasSlug;
use Illuminate\Support\Collection;
use App\Models\Enums\SpecialArticle;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use App\Models\Presenters\ArticlePresenter;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected $mediaLibraryCollections = ['images', 'downloads'];

    public $translatable = ['name', 'text', 'slug', 'meta_values'];

    public function registerMediaConversions()
    {
        parent::registerMediaConversions();

        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->optimize()
            ->performOnCollections('images');
    }

    public function isSpecialArticle($specialArticleName = ''): bool
    {
        if ($specialArticleName === '') {
            return ! empty($this->technical_name);
        }

        return $this->technical_name === $specialArticleName;
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

    public function getUrlAttribute(): string
    {
        $localeSegment = '';

        if (locales()->count() > 1) {
            $localeSegment = '/'.locale();
        }

        if ($this->technical_name === SpecialArticle::HOME) {
            return $localeSegment;
        }

        $parentSlug = $this->hasParent() ? $this->parent->slug.'/' : '';

        return "{$localeSegment}/{$parentSlug}{$this->slug}";
    }
}
