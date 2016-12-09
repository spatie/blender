<?php

use App\Services\Auth\Back\User;
use App\Services\Auth\Back\Enums\UserRole;
use App\Services\Auth\Back\Enums\UserStatus;

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
            $password = app()->environment('local') ? strtolower($firstName) : string()->random();

            User::create([
                'email' => strtolower($firstName).'@spatie.be',
                'password' => bcrypt($password),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'role' => UserRole::ADMIN(),
                'status' => UserStatus::ACTIVE(),
            ]);
        });
    }
}
