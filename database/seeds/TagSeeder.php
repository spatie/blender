<?php

use App\Models\Enums\TagType;
use App\Models\Tag;
use App\Models\Translations\TagTranslation;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Seeders\SuperSeeder\Factory;

class TagSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new TagTranslation())->getTable(), (new Tag())->getTable(), 'taggables');

        $this->seedRandomTags();
    }

    public function seedRandomTags($amount = 10)
    {
        $tags = new Collection();

        for ($i = 0; $i < $amount; ++$i) {
            $tag = Tag::findByNameOrCreate($this->faker->words(2, true), TagType::NEWS_TAG());
            $tags->add($tag);
        }

        return $tags;
    }
}

class TagFactory extends Factory
{
    public function isModel($data)
    {
        return isset($data['name']);
    }

    public function initialize($model, $data, $carry)
    {
        $model->draft = false;
        $model->online = true;
        $model->type = $carry[0];
    }

    public function setName($model, $value)
    {
        $locales = array_fill_keys(config('app.locales'), null);

        if (is_array($value)) {
            $translations = array_merge($locales, $value);
            $defaultTranslation = $value[config('app.locale')];
        } else {
            $translations = array_merge($locales, [config('app.locale') => $value]);
            $defaultTranslation = $value;
        }

        foreach ($translations as $locale => $translation) {
            $model->translate($locale)->name = $translation ?: "$defaultTranslation $locale";
        }
    }
}
