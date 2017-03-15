<?php

namespace Tests\Concerns;

use ArticleSeeder;
use FragmentSeeder;

trait RunsSeeders
{
    protected static $seeded = false;

    protected function runSeeders()
    {
        if (static::$seeded) {
            return;
        }

        $this->artisan('db:seed', ['--class' => FragmentSeeder::class]);
        $this->artisan('db:seed', ['--class' => ArticleSeeder::class]);

        static::$seeded = true;
    }
}
