<?php

namespace Tests\Concerns;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\DatabaseTransactions;

trait UsesDatabase
{
    use DatabaseTransactions;

    protected static $migrated = false;

    protected function setUpDatabase(callable $afterMigration = null)
    {
        $this->setUpSqlite();

        $this->artisan('migrate');

        $this->app->make(Kernel::class)->setArtisan(null);

        if ($afterMigration) {
            $afterMigration();
        }

        static::$migrated = true;
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

    protected function beginDatabaseTransaction()
    {
        $database = $this->app->make('db');

        foreach ($this->connectionsToTransact() as $name) {
            $database->connection($name)->beginTransaction();
        }

        $this->beforeApplicationDestroyed(function () use ($database) {
            foreach ($this->connectionsToTransact() as $name) {
                $database->connection($name)->rollBack();
            }
        });
    }
}
