<?php

use App\Models\Fragment;
use App\Models\Translations\FragmentTranslation;
use Faker\Generator;

$factory->define(Fragment::class, function (Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(FragmentTranslation::class, function (Generator $faker) {
    return [
        'text' => $faker->words(2, true),
    ];
});
