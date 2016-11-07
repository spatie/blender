<?php

use App\Models\Tag;

class TagSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new Tag())->getTable(), 'taggables');

        $this->seedTags('newsCategory', [
            'Categorie 1',
            'Categorie 2',
            'Categorie 3',
        ]);

        $this->seedTags('newsTag', [
            'Tag 1',
            'Tag 2',
            'Tag 3',
        ]);
    }

    public function seedTags($type, array $names)
    {
        foreach ($names as $i => $name) {
            Tag::create([
                'type' => $type,
                'name' => faker()->translate($name),
                'draft' => 0,
                'online' => 1,
                'order_column' => $i,
            ]);
        }
    }
}
