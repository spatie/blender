<?php

use App\Services\Auth\Front\Enums\UserRole;
use App\Services\Auth\Front\Enums\UserStatus;
use App\Services\Auth\Front\User;

$factory->define(User::class, function () {

    $person = faker()->person();

    return [
        'first_name' => $person['firstName'],
        'last_name' => $person['lastName'],
        'email' => $person['email'],
        'password' => app()->environment('local') ?
            strtolower($person['firstName']) :
            faker()->password,

        'locale' => 'nl',

        'role' => UserRole::MEMBER(),
        'status' => UserStatus::ACTIVE(),

        'address' => faker()->address,
        'postal' => faker()->postcode,
        'city' => faker()->city,
        'country' => faker()->country,
        'telephone' => faker()->phoneNumber,
    ];
});
