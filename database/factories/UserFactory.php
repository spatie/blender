<?php

use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;
use Faker\Generator;

$factory->define(App\Models\User::class, function (Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => $faker->password,

        'locale' => 'nl',

        'role' => (string) collect(UserRole::values())->random(1),
        'status' => (string) collect(UserStatus::values())->random(1),

        'address' => $faker->address,
        'postal' => $faker->postcode,
        'city' => $faker->city,
        'country' => $faker->country,
        'telephone' => $faker->phoneNumber,
    ];
});

$factory->define('admin', function (Generator $faker) {
    
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => $faker->password,

        'locale' => 'nl',

        'role' => UserRole::ADMIN,
        'status' => UserStatus::ACTIVE,

        'address' => $faker->address,
        'postal' => $faker->postcode,
        'city' => $faker->city,
        'telephone' => $faker->phoneNumber,
    ];
});
