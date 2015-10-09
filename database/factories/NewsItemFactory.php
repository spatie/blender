<?php

use App\Models\NewsItem;
use App\Models\Translations\NewsItemTranslation;
use Carbon\Carbon;
use function Spatie\array_rand_weighted;
use Faker\Generator;

$factory->define(NewsItem::class, function (Generator $faker) {
    return [
        'draft' => false,
        'online' => $faker->boolean(80),
        'publish_date' => Carbon::now()->addMinutes(-rand(0, 60 * 24 * 7)),
        'size' => array_rand_weighted(['small' => 2, 'large' => 1]),
    ];
});

$factory->define(NewsItemTranslation::class, function (Generator $faker) {
    return [
        'locale' => 'nl',
        'name' => $faker->sentence,
        'text' => $faker->paragraph,
    ];
});
