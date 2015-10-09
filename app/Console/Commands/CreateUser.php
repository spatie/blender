<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'user:create {email} {firstName} {lastName} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an administrator user.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::create([
            'email' => $this->argument('email'),
            'first_name' => $this->argument('firstName'),
            'last_name' => $this->argument('lastName'),
            'password' => $this->argument('password') ?: null,
            'admin' => true,
        ]);

        $this->info("User {$user->email} has been created!");
    }
}
