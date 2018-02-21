<?php

use App\Models\User;
use App\Services\Auth\User as BaseUser;

class UserSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new User())->getTable());

        collect([
            ['Freek', 'Van der Herten'],
            ['Jef', 'Van der Voort'],
            ['Alex', 'Van der Bist'],
            ['Sebastian', 'De Deyne'],
            ['Willem', 'Van Bockstal'],
            ['Harish', 'Toshniwal'],
        ])->each(function ($name) {
            [$firstName, $lastName] = $name;

            $this->createUser([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => strtolower($firstName).'@spatie.be',
                'password' => bcrypt(strtolower($firstName)),
                'status' => BaseUser::STATUS_ACTIVE,
            ]);
        });

        collect()->range(0, 10)->each(function () {
            $this->createUser();
        });
    }

    public function createUser(array $attributes = []): User
    {
        $person = faker()->person();

        return User::create($attributes + [
            'first_name' => $person['firstName'],
            'last_name' => $person['lastName'],
            'email' => $person['email'],
            'password' => bcrypt($person['firstName']),

            'locale' => 'nl',

            'role' => BaseUser::ROLE_MEMBER,
            'status' => BaseUser::STATUS_ACTIVE,

            'address' => faker()->address,
            'postal' => faker()->postcode,
            'city' => faker()->city,
            'country' => faker()->country,
            'telephone' => faker()->phoneNumber,
        ]);
    }
}
