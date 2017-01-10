<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Blender\Model\Traits\HasMedia;
use Spatie\Blender\Model\Traits\Draftable;
use Spatie\EloquentSortable\SortableTrait;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class ContentBlock extends Model implements HasMediaConversions
{
    use Draftable, SortableTrait, HasTranslations, HasMedia;

    public $translatable = ['name', 'text'];
    protected $guarded = [];

    public function subject(): MorphTo
    {
        return $this->morphTo('model');
    }

    public function registerMediaConversions()
    {
        $this->addMediaConversion('admin')
            ->setWidth(368)
            ->setHeight(232)
            ->nonQueued();

        $this->addMediaConversion('thumb')
            ->setWidth(368)
            ->setHeight(232);

        $this->addMediaConversion('detail')
            ->setWidth(740);
    }

    public function mediaLibraryCollections(): array
    {
        return array_keys($this->subject->getContentBlockMediaLibraryCollections());
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

            $this->media()
                ->whereCollectionName($collection)
                ->whereNotIn('id', Arr::pluck($updatedMedia, 'id'))
                ->delete();
        }

        $this->save();

        return $this;
    }

    public function setOrder(int $i)
    {
        $this->order_column = $i;

        $this->save();

        return $this;
    }
}
