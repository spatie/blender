<?php

use App\Models\Tag;
use Illuminate\Support\Collection;

class TagSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new Tag())->getTable(), 'taggables');

        $this->createTags('newsCategory', [
            'Category 1',
            'Category 2',
            'Category 3',
        ]);

        $this->createTags('newsTag', [
            'Tag 1',
            'Tag 2',
            'Tag 3',
        ]);
    }

    public function createTags(string $type, array $names): Collection
    {
        return collect($names)->each(function ($name) use ($type) {
            $this->createTag([
                'name' => faker()->translate($name),
                'type' => $type,
            ]);
        });
    }

    public function createTag(array $attributes = []): Tag
    {
        return Tag::create($attributes + [
            'type' => 'default',
            'name' => faker()->translate(faker()->name()),
            'draft' => 0,
            'online' => 1,
        ]);
    }
}
