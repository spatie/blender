<?php

use App\Services\Auth\Front\Enums\UserRole;
use App\Services\Auth\Front\Enums\UserStatus;
use App\Services\Auth\Front\User;
use Faker\Generator;

$factory->define(User::class, function (Generator $faker) {
    $firstName = $faker->firstName;
    $lastName = $faker->lastName;

    return [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => strtolower("{$firstName}.{$lastName}@spatie.be"),
        'password' => app()->environment('local') ? strtolower($firstName) : string()->random(),

        'locale' => 'nl',

        'role' => UserRole::MEMBER(),
        'status' => UserStatus::ACTIVE(),

        'address' => $faker->address,
        'postal' => $faker->postcode,
        'city' => $faker->city,
        'country' => $faker->country,
        'telephone' => $faker->phoneNumber,
    ];
});
