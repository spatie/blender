<?php

use App\Models\Person;
use App\Models\Translations\PersonTranslation;

class PersonSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new PersonTranslation())->getTable(), (new Person())->getTable());

        $this->seedRandomPeople(25, false);
    }

    public function seedRandomPeople($amount = 10, $withImages = false)
    {
        return factory(Person::class, $amount)
            ->create()
            ->each(function ($person) use ($withImages) {
                foreach (config('app.locales') as $locale) {
                    $translation = factory(PersonTranslation::class)->make(['locale' => $locale]);
                    $person->translations()->save($translation);
                }

                if ($withImages) {
                    $this->addImages($person, 1, 1);
                }
            })
            ->load('translations', 'media');
    }
}
