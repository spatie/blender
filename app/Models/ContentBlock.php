<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Blender\Model\Traits\Draftable;
use Spatie\Blender\Model\Traits\HasMedia;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\Translatable\HasTranslations;

class ContentBlock extends Model implements HasMediaConversions
{
    use Draftable, SortableTrait, HasTranslations, HasMedia;

    public $mediaLibraryCollections = ['images', 'downloads'];

    public $translatable = ['name', 'text'];

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
}
