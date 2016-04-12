<?php

use App\Models\Person;

class PersonSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new Person())->getTable());

        $this->seedRandomPeople(25, false);
    }

    public function seedRandomPeople($amount = 10, $withImages = true)
    {
        return factory(Person::class, $amount)
            ->create()
            ->each(function ($person) use ($withImages) {
                if ($withImages) {
                    $this->addImages($person, 1, 1);
                }
            });
    }
}
