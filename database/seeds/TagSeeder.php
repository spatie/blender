<?php

use App\Models\Tag;
use App\Models\Translations\TagTranslation;
use App\Repositories\TagRepository;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Seeders\SuperSeeder\Factory;

class TagSeeder extends DatabaseSeeder
{
    /**
     * @var \App\Repositories\TagRepository
     */
    protected $tagRepository;

    /**
     * @param \App\Repositories\TagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        parent::__construct();

        $this->tagRepository = $tagRepository;
    }

    public function run()
    {
        $this->truncate((new TagTranslation())->getTable(), (new Tag())->getTable(), 'taggables');

        $this->superSeeder(new TagFactory(Tag::class), 'tags');
    }

    public function seedRandomTags($amount = 10)
    {
        $tags = new Collection();

        for ($i = 0; $i < $amount; ++$i) {
            $tag = app()->make(TagRepository::class)->findByNameOrCreate($this->faker->words(2, true));
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
