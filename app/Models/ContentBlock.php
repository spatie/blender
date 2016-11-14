<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Blender\Model\Traits\Draftable;
use Spatie\Blender\Model\Traits\HasMedia;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\Translatable\HasTranslations;

class ContentBlock extends Model implements HasMediaConversions
{
    use Draftable, SortableTrait, HasTranslations, HasMedia;

    public $translatable = ['name', 'text'];

    public function subject(): MorphTo
    {
        return $this->morphTo('model');
    }

    public function registerMediaConversions()
    {
        parent::registerMediaConversions();

        $this->addMediaConversion('thumb')
            ->setWidth(368)
            ->setHeight(232)
            ->performOnCollections('images');
    }

    public function updateWithValues($values)
    {
        $this->type = $values['type'];

        collect($this->translatable)->each(function(string $attribute) use ($values) {
           foreach(config('app.locales') as $locale) {
               $this->setTranslation($attribute, $locale, $values['attribute'][$locale]);
           }
        });

        foreach($this->mediaLibraryCollections as $collectionName) {
            $this->updateMedia($values[$collectionName], $collectionName);
        }

        $this->save();
    }

    public function getMediaCollectionNames(): array
    {
        return $this->subject->getContentBlockMediaCollectionNames();
    }
}
