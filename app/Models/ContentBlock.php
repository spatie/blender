<?php

namespace App\Models;

use App\Models\Traits\Draftable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Arr;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Translatable\HasTranslations;

class ContentBlock extends Model implements HasMedia
{
    use Draftable, SortableTrait, HasTranslations;
    use Traits\HasMedia;

    public $translatable = ['name', 'text'];
    protected $guarded = ['id'];
    protected $casts = [
        'properties' => 'array',
    ];

    public function subject(): MorphTo
    {
        return $this->morphTo('model')->withoutGlobalScopes();
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('admin')
            ->width(368)
            ->height(232)
            ->optimize()
            ->nonQueued();

        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->optimize();

        $this->addMediaConversion('detail')
            ->width(740)
            ->optimize();
    }

    public function mediaLibraryCollections(): array
    {
        return $this->subject->getContentBlockMediaLibraryCollections();
    }

    public function mediaLibraryCollectionType(string $name): string
    {
        return $this->subject->getContentBlockMediaLibraryCollections()[$name];
    }

    public function updateWithAttributes(array $values)
    {
        $this->draft = false;
        $this->type = $values['type'];

        foreach ($this->translatable as $attribute) {
            $this->setTranslations($attribute, $values[$attribute] ?? []);
        }

        foreach ($this->mediaLibraryCollections() as $collection) {
            if (! isset($values[$collection])) {
                continue;
            }

            $media = array_filter($values[$collection], function ($media) {
                return ($media['markedForRemoval'] ?? false) !== true;
            });

            $updatedMedia = $this->updateMedia($media, $collection);

            $updatedMedia->each(function (Media $media) {
                $media
                    ->setCustomProperty('draft', false)
                    ->save();
            });

            $this->media()
                ->whereCollectionName($collection)
                ->whereNotIn('id', Arr::pluck($updatedMedia, 'id'))
                ->delete();
        }

        $this->properties = $this->getNonDefaultProperties($values);

        $this->save();

        return $this;
    }

    protected function getNonDefaultProperties(array $values): array
    {
        return collect($values)
            ->except('id', 'type', 'orderColumn', 'text', 'name')
            ->except(...$this->mediaLibraryCollections())
            ->toArray();
    }

    public function setOrder(int $i)
    {
        $this->order_column = $i;

        $this->save();

        return $this;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->getAttribute('properties') ?? [])) {
            return $this->properties[$key][locale()];
        }

        return parent::__get($key);
    }
}
