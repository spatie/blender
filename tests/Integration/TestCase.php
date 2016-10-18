<?php

namespace App\Test\Integration;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Seeders\DatabaseSeeder;

abstract class TestCase extends BaseTestCase
{
    /** @var string */
    protected $baseUrl = 'http://localhost';

    public function setUp()
    {
        parent::setUp();

        DatabaseSeeder::$withMedia = false;

        $this->artisan('migrate');
        $this->artisan('db:seed', ['--class' => 'ArticleSeeder']);
    }

    public function createApplication(): Application
    {
        file_put_contents(__DIR__.'/../../storage/database.sqlite', null);

        $app = require __DIR__.'/../../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
