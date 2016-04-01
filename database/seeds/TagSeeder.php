<?php

use App\Models\Enums\TagType;
use App\Models\Tag;
use App\Models\Translations\TagTranslation;

class TagSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new TagTranslation())->getTable(), (new Tag())->getTable(), 'taggables');

        $this->seedTags(TagType::NEWS_CATEGORY(), [
            'Categorie 1',
            'Categorie 2',
            'Categorie 3',
        ]);

        $this->seedTags(TagType::NEWS_TAG(), [
            'Tag 1',
            'Tag 2',
            'Tag 3',
        ]);
    }

    public function seedTags(TagType $type, array $names)
    {
        foreach ($names as $i => $name) {
            Tag::create([
                'type' => $type,
                'name' => $name,
                'draft' => 0,
                'online' => 1,
                'order_column' => $i,
            ]);
        }
    }
}
