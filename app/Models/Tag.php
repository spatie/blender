<?php

namespace App\Models;

use Spatie\Tags\Tag as SpatieTag;
use App\Models\Presenters\TagPresenter;
use Spatie\Blender\Model\Traits\Draftable;

class Tag extends SpatieTag
{
    use TagPresenter, Draftable;

    /**
     * @param string $type
     *
     * @return bool
     */
    public function hasType(string $type): bool
    {
        return $this->type === $type;
    }

    public static function findOrCreate($name, string $type = null, string $locale = null): Tag
    {
        if ($existingTag = parent::findFromString($name, $type)) {
            return $existingTag;
        }

        $tag = parent::findOrCreate($name, $type);

        $tag->setTranslations('name', array_fill_keys(config('app.locales'), $name));

        $tag->save();

        return $tag;
    }
}
