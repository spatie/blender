<?php

use App\Models\Person;
use App\Models\Translations\PersonTranslation;
use Faker\Generator;

$factory->define(Person::class, function (Generator $faker) {
    return [
        'name' => $faker->name,
        'draft' => false,
        'online' => true,
    ];
});

$factory->define(PersonTranslation::class, function (Generator $faker) {
    return [
        'text' => $faker->paragraphs(2, true),
    ];
});
