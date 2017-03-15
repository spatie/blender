<?php

namespace Tests\Concerns;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Console\Kernel;

trait UsesDatabase
{
    protected function setUpDatabase()
    {
        $this->setUpSqlite();

        $this->artisan('migrate');

        $this->app->make(Kernel::class)->setArtisan(null);
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
