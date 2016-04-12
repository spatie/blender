<?php

use App\Models\Article;

$factory->define(Article::class, function () {
    return [
        'name' => faker()->translate(faker()->title()),
        'text' => faker()->translate(faker()->text()),
        'online' => faker()->mostly(),
        'draft' => false,
    ];
});
