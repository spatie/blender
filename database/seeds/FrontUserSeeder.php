<?php

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

            factory(User::class)->create([
                'email' => strtolower($firstName).'@spatie.be',
                'password' => app()->environment('local') ? strtolower($firstName) : string()->random(),
                'first_name' => "{$firstName} (Front)",
                'last_name' => $lastName,
            ]);
        });
    }
}
