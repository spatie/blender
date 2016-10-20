<?php

use App\Models\Article;
use App\Models\Translations\ArticleTranslation;
use Carbon\Carbon;
use Faker\Generator;

$factory->define(Article::class, function (Generator $faker) {
    return [
        'draft'        => false,
        'online'       => $faker->boolean(80),
        'publish_date' => Carbon::now()->addMinutes(-rand(0, 60 * 24 * 7)),
    ];
});

$factory->define(ArticleTranslation::class, function (Generator $faker) {
    return [
        'locale' => 'nl',
        'name'   => $faker->sentence,
        'text'   => '<p class="intro">'.$faker->paragraph(6).'</p><h3>'.$faker->sentence(6).'</h3><p>'.$faker->paragraph(9).'</p><blockquote>'.$faker->paragraph(7).'</blockquote><h3>'.$faker->sentence(6).'</h3><p>'.$faker->paragraph(10).'</p><p>'.$faker->paragraph(8).'</p>',
    ];
});
