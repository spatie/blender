<?php

namespace App\Models\Foundation\Base;

use App\Models\Foundation\Traits\Draftable;
use App\Models\Foundation\Traits\HasOnlineToggle;
use App\Models\Foundation\Traits\HasTags;
use App\Models\Foundation\Traits\Presentable;
use App\Models\Foundation\Traits\HasMedia as HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\MediaRepository;

abstract class ModuleModel extends TranslatableEloquent implements HasMediaConversions
{
    use Draftable, Presentable, HasMediaTrait;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Update a model from an attributes array. This method also automagically handles the following traits:
     * - HasMedia
     * - HasOnlineToggle
     * - HasTags.
     *
     * @param array $attributes
     *
     * @return \App\Models\Foundation\Base\ModuleModel
     */
    public function updateWithRelations(array $attributes)
    {
        $this->updateTranslatedFields($attributes);

        $traits = class_uses_recursive(get_class($this));

        if (array_key_exists(HasMediaTrait::class, $traits)) {
            $this->updateMediaLibraryFields($attributes);
        }

        if (array_key_exists(HasOnlineToggle::class, $traits)) {
            $this->updateOnlineToggle($attributes);
        }

        if (array_key_exists(HasTags::class, $traits)) {
            $this->updateAllTags($attributes);
        }

        return $this;
    }

    /**
     * @param array $attributes
     */
    protected function updateTranslatedFields($attributes)
    {
        foreach (config('app.locales') as $locale) {
            foreach ($this->translatedAttributes as $fieldName) {
                $translatedFieldName = translate_field_name($fieldName, $locale);

                if (!isset($attributes[$translatedFieldName])) {
                    continue;
                }

                $value = $attributes[$translatedFieldName];
                $this->translate($locale)->$fieldName = $value;
            }
        }
    }

    /**
     * Get media collection by its collectionName.
     *
     * @param string $collectionName
     * @param array  $filter
     *
     * @return \Illuminate\Support\Collection
     */
    public function getMedia($collectionName = '', $filter = [])
    {
        return app(MediaRepository::class)->getCollection($this, $collectionName, $filter);
    }

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
}
