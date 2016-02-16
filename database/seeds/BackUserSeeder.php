<?php

use App\Services\Auth\Back\Enums\UserRole;
use App\Services\Auth\Back\Enums\UserStatus;
use App\Services\Auth\Back\User;

class BackUserSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new User())->getTable());

        $this->seedAdmins();
    }

    public function seedAdmins()
    {
        $users = [
            'Willem' => 'Van Bockstal',
            'Freek' => 'Van der Herten',
            'Rogier' => 'De Boevé',
            'Sebastian' => 'De Deyne',
        ];

        collect($users)->each(function ($lastName, $firstName) {

            User::create([
                'email' => strtolower($firstName) . '@spatie.be',
                'password' => app()->environment('local') ? strtolower($firstName) : string()->random(),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'role' => UserRole::ADMIN(),
                'status' => UserStatus::ACTIVE(),
            ]);
        });
    }
}
