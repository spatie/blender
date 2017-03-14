<?php

namespace Tests;

use ArticleSeeder;
use FragmentSeeder;
use Illuminate\Support\Facades\DB;
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
        $this->setUpSqlite();

        $this->artisan('migrate:fresh');
        $this->artisan('db:seed', ['--class' => FragmentSeeder::class]);
        $this->artisan('db:seed', ['--class' => ArticleSeeder::class]);
    }

    protected function setUpSqlite()
    {
        DB::getPdo()->sqliteCreateFunction('regexp',
            function ($pattern, $data, $delimiter = '~', $modifiers = 'isuS') {
                if (isset($pattern, $data) !== true) {
                    return null;
                }

                return preg_match(sprintf('%1$s%2$s%1$s%3$s', $delimiter, $pattern, $modifiers), $data) > 0;
            }
        );
    }
}
