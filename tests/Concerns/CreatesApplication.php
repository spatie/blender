<?php

namespace Tests\Concerns;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Contracts\Hashing\Hasher;

trait CreatesApplication
{
    public function createApplication()
    {
        $app = require __DIR__.'/../../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        $app->make(Hasher::class)->setRounds(4);

        return $app;
    }
}
