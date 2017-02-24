<?php

namespace Tests;

use FragmentSeeder;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Hash;

trait CreatesApplication
{
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        Hash::setRounds(5);

        return $app;
    }

    protected function setUpDatabase()
    {
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed', ['--class' => FragmentSeeder::class]);
    }
}
