<?php

namespace App\Foundation\Models\Traits;

use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Note: don't forget to set protected $tagTypes.
 */
trait HasTags
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Get all the model's tags from a certain type.
     *
     * @param string|null $type
     *
     * @return array
     */
    public function getTags($type = null)
    {
        $type = $type ?: static::getDefaultTagType();

        return $this->tags->filter(function ($tag) use ($type) {
            return ($tag->type == $type);
        });
    }

    /**
     * Return an array of tag names and urls in the current locale.
     *
     * @param string|null $type
     * @param string|null $locale
     *
     * @return array
     */
    public function getTagNames($type = null, $locale = null)
    {
        $type = $type ?: static::getDefaultTagType();
        $locale = $locale ?: static::getDefaultTagLocale();

        return $this->getTags($type)
            ->map(function ($tag) use ($locale) {
                return $tag->translate($locale)->name;
            })
            ->toArray();
    }

    /**
     * Sync tags from an array of strings.
     *
     * @param array       $strings
     * @param string|null $type
     * @param string|null $locale
     */
    public function addTagsFromNameArray(array $strings, $type = null, $locale = null)
    {
        $type = $type ?: static::getDefaultTagType();
        $locale = $locale ?: static::getDefaultTagLocale();

        $tags = (new Collection($strings))->map(function ($name) use ($type, $locale) {
            return app(TagRepository::class)->findByNameOrCreate($name, $type, $locale);
        });

        foreach ($tags as $tag) {
            $this->tags()->attach($tag);
        }
    }

    /**
     * @return string
     */
    public static function getDefaultTagLocale()
    {
        return content_locale();
    }

    /**
     * @return string
     */
    public static function getDefaultTagType()
    {
        return 'main';
    }
}
