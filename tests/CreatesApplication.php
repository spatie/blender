<?php

namespace Tests;

use ArticleSeeder;
use ErrorException;
use FragmentSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        Hash::setRounds(5);

        return $app;
    }

    protected function setUpDatabase()
    {
        try {
            unlink(config('database.sqlite.database'));
        } catch (ErrorException $e) {}

        touch(config('database.sqlite.database'));

        $this->artisan('migrate:fresh');
        $this->artisan('db:seed', ['--class' => FragmentSeeder::class]);
        $this->artisan('db:seed', ['--class' => ArticleSeeder::class]);
    }
}
