<?php

use App\Services\Auth\Back\Enums\UserRole;
use App\Services\Auth\Back\Enums\UserStatus;
use App\Services\Auth\Back\User;

class BackUserSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new User())->getTable());

        collect([
            ['Adriaan', 'Marain'],
            ['Alex', 'Vanderbist'],
            ['Brent', 'Roose'],
            ['Freek', 'Van der Herten'],
            ['Jef', 'Van der Voort'],
            ['Ruben', 'Van Assche'],
            ['Sebastian', 'De Deyne'],
            ['Willem', 'Van Bockstal'],
            ['Wouter', 'Brouwers'],
        ])->each(function ($name) {
            [$firstName, $lastName] = $name;

            $this->createBackUser([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => strtolower($firstName).'@spatie.be',
                'password' => bcrypt(strtolower($firstName)),
                'role' => UserRole::ADMIN,
                'status' => UserStatus::ACTIVE,
            ]);
        });
    }

    public function createBackUser(array $attributes = []): User
    {
        $person = faker()->person();

        return User::create($attributes + [
            'first_name' => $person['firstName'],
            'last_name' => $person['lastName'],
            'email' => $person['email'],
            'password' => faker()->password,

            'role' => UserRole::ADMIN,
            'status' => UserStatus::ACTIVE,
        ]);
    }
}
