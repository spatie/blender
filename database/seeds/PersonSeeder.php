<?php

use App\Models\Person;

class PersonSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate(Person::class);

        collect()->range(0, 10)->each(function () {
            $this->createPerson();
        });
    }

    public function createPerson(array $attributes = []): Person
    {
        $person = Person::create($attributes + [
            'name' => faker()->name,
            'text' => faker()->translate(faker()->sentences(2)),
            'online' => faker()->mostly(),
            'draft' => false,
        ]);

        $this->addImages($person, 1, 1, 'images', 'people');

        return $person;
    }
}
