<?php

namespace App\Models;

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
            ->setHeight(232)
            ->performOnCollections('images');
    }

    public function mediaLibraryCollectionNames(): array
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

        foreach ($this->mediaLibraryCollectionNames() as $collection) {
            $media = collect($values['media'])
                ->where('collection', $collection)
                ->first()['media'] ?? [];

            $this->updateMedia($media, $collection);
        }

        $this->save();

        return $this;
    }
}
