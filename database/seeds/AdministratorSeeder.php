<?php

use App\Models\Administrator;
use App\Services\Auth\Back\Enums\UserRole;
use App\Services\Auth\Back\Enums\UserStatus;

class AdministratorSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new Administrator())->getTable());

        collect([
            ['Alex', 'Vanderbist'],
            ['Brent', 'Roose'],
            ['Freek', 'Van der Herten'],
            ['Harish', 'Toshniwal'],
            ['Jef', 'Van der Voort'],
            ['Sebastian', 'De Deyne'],
            ['Willem', 'Van Bockstal'],
        ])->each(function ($name) {
            [$firstName, $lastName] = $name;

            $this->createAdministrator([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => strtolower($firstName).'@spatie.be',
                'password' => bcrypt(strtolower($firstName)),
                'role' => UserRole::ADMIN,
                'status' => UserStatus::ACTIVE,
            ]);
        });
    }

    public function createAdministrator(array $attributes = []): Administrator
    {
        $person = faker()->person();

        return Administrator::create($attributes + [
            'first_name' => $person['firstName'],
            'last_name' => $person['lastName'],
            'email' => $person['email'],
            'password' => faker()->password,

            'role' => UserRole::ADMIN,
            'status' => UserStatus::ACTIVE,
        ]);
    }
}
