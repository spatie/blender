<?php

namespace Tests\Concerns;

use Illuminate\Contracts\Console\Kernel;

trait UsesMySqlDatabase
{
    protected static $migrated = false;

    protected function setUpDatabase(callable $afterMigrating = null)
    {
        if (static::$migrated) {
            $this->beginDatabaseTransaction();
            return;
        }

        $this->artisan('migrate');

        $this->app->make(Kernel::class)->setArtisan(null);

        if ($afterMigrating) {
            $afterMigrating();
        }

        static::$migrated = true;

        $this->beginDatabaseTransaction();
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
        return property_exists($this, 'connectionsToTransact') ?
            $this->connectionsToTransact :
            [null];
    }
}
