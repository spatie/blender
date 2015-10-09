<?php

use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;
use App\Models\User;

class UserSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new User())->getTable());

        $this->seedAdmins();

        $this->seedOtherRoles();
    }

    protected function seedAdmins()
    {
        $users = [
            'Willem' => 'Van Bockstal',
            'Freek' => 'Van der Herten',
            'Rogier' => 'De Boevé',
            'Sebastian' => 'De Deyne',
        ];

        foreach ($users as $firstName => $lastName) {
            factory(User::class)->create([
                'email' => strtolower($firstName).'@spatie.be',
                'password' => app()->env == 'local' ? strtolower($firstName) : string()->random(),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'role' => UserRole::ADMIN,
                'status' => UserStatus::ACTIVE,
            ]);
        }
    }

    protected function seedOtherRoles()
    {
        foreach (UserRole::values() as $role) {
            if ($role != UserRole::ADMIN) {
                $this->seedUserWithRole($role);
            }
        }
    }

    protected function seedUserWithRole($role, $amount = 20) {
        foreach(range(1,20) as $index) {

            $baseEmail = "{$role}{$index}";

            factory(User::class)->create([
                'email' => "{$baseEmail}@spatie.be",
                'password' => $baseEmail,
                'role' => $role,
                'status' => $this->faker->boolean(80) ? UserStatus::ACTIVE : UserStatus::WAITING_FOR_APPROVAL,
            ]);
        }
    }
}
