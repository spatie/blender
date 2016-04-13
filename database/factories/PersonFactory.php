<?php

use App\Models\Person;

$factory->define(Person::class, function () {
    return [
        'name' => faker()->name,
        'text' => faker()->translate(faker()->sentences(2)),
        'online' => faker()->mostly(),
        'draft' => false,
    ];
});
