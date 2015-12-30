<?php

namespace App\Foundation\Models\Updaters;

use App\Models\Enums\TagType;
use App\Models\Tag;

trait UpdatesTags
{
    public function updateTags()
    {
        $this->model->tags()->detach();

        foreach ($this->model->tagTypes as $type) {
            $this->updateTagsForType($type);
        }
    }

    public function updateTagsForType(string $type)
    {
        collect($this->request->get("{$type}_tags"))->each(function ($name) use ($type) {
            $type = new TagType($type);

            $tag = Tag::findByNameOrCreate($name, $type);

            $this->model->tags()->attach($tag);
        });
    }
}
