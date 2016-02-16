<?php

use App\Services\Auth\Back\Enums\UserRole;
use App\Services\Auth\Back\Enums\UserStatus;
use App\Services\Auth\Back\User;
use Faker\Generator;

$factory->define(User::class, function (Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => $faker->password,

        'locale' => 'nl',

        'role' => UserRole::ADMIN(),
        'status' => UserStatus::ACTIVE(),
    ];
});
