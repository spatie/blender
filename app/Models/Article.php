<?php

namespace App\Models;

use App\Models\Enums\SpecialArticle;
use App\Models\Presenters\ArticlePresenter;
use App\Models\Traits\HasContentBlocks;
use App\Models\Traits\HasSlug;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * @property \App\Models\Article $parent
 * @property \Illuminate\Support\Collection $children
 * @property \App\Models\Article $firstChild
 * @property \Illuminate\Support\Collection $siblings
 */
class Article extends Model implements Sortable
{
    use ArticlePresenter, HasSlug, SortableTrait, HasContentBlocks;

    protected $with = ['media'];

    protected $mediaLibraryCollections = ['images', 'downloads'];
    protected $contentBlockMediaLibraryCollections = ['images'];

    public $translatable = ['name', 'text', 'slug', 'meta_values'];

    public function registerMediaConversions(Media $media = null)
    {
        parent::registerMediaConversions();

        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
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

    public function getFirstChildAttribute(): self
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
        return ! is_null($this->parent_id);
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
