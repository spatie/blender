<?php

use App\Services\Auth\Back\Enums\UserRole;
use App\Services\Auth\Back\Enums\UserStatus;
use App\Services\Auth\Back\User;

$factory->define(User::class, function () {

    $person = faker()->person();

    return [
        'first_name' => $person['firstName'],
        'last_name' => $person['lastName'],
        'email' => $person['email'],
        'password' => faker()->password,

        'locale' => 'nl',

        'role' => UserRole::ADMIN(),
        'status' => UserStatus::ACTIVE(),
    ];
});
