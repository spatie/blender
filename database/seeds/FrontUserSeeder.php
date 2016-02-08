<?php

use App\Services\Auth\Front\User;

class FrontUserSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new User())->getTable());

        $this->seedRandomFrontUsers();
    }

    public function seedRandomFrontUsers($amount = 10)
    {
        return factory(User::class, $amount)->create();
    }
}
