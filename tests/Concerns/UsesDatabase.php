<?php

namespace Tests\Concerns;

use Illuminate\Contracts\Console\Kernel;

trait UsesDatabase
{
    /** @var string */
    protected $database = __DIR__.'/../../database/database.sqlite';

    /** @var bool */
    protected static $migrated = false;

    protected function prepareDatabase()
    {
        // The database needs to be deleted before the application gets boted
        // to avoid having the database in a weird read-only state.

        if (static::$migrated) {
            return;
        }

        @unlink($this->database);
        touch($this->database);
    }

    protected function setUpDatabase(callable $afterMigrations = null)
    {
        if (static::$migrated) {
            return;
        }

        $this->artisan('migrate');

        $this->app[Kernel::class]->setArtisan(null);

        if ($afterMigrations) {
            $afterMigrations();
        }

        static::$migrated = true;
    }

    public function beginDatabaseTransaction()
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

    protected function connectionsToTransact(): array
    {
        return property_exists($this, 'connectionsToTransact')
            ? $this->connectionsToTransact : [null];
    }
}
