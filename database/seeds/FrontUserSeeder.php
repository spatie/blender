<?php

use App\Services\Auth\Front\Enums\UserStatus;
use App\Services\Auth\Front\User;

class FrontUserSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new User())->getTable());

        $this->seedSpatieUsers();
        $this->seedRandomFrontUsers();
    }

    public function seedRandomFrontUsers($amount = 10)
    {
        return factory(User::class, $amount)->create([]);
    }

    public function seedSpatieUsers()
    {
        $users = [
            'Willem' => 'Van Bockstal',
            'Freek' => 'Van der Herten',
            'Rogier' => 'De Boevé',
            'Sebastian' => 'De Deyne',
        ];

        collect($users)->each(function ($lastName, $firstName) {
            $password = app()->environment('local') ? strtolower($firstName) : string()->random();

            factory(User::class)->create([
                'email' => strtolower($firstName).'@spatie.be',
                'password' => bcrypt($password),
                'first_name' => "{$firstName}",
                'last_name' => $lastName,
                'status' => UserStatus::ACTIVE(),
            ]);
        });
    }
}
