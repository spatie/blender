<?php

namespace App\Models\Foundation\Updaters;

trait UpdatesTags
{
    public function updateTags()
    {
        $this->model->tags()->detach();

        foreach ($this->model->tagTypes as $type) {

            if (! $this->request->has("{$type}_tags")) {
                continue;
            }

            $this->model->addTagsFromNameArray($this->request->get("{$type}_tags"), $type);
        }
    }
}
