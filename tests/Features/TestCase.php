<?php

namespace Tests\Features;

use ArticleSeeder;
use Tests\Concerns\CreatesApplication;
use Tests\Concerns\UsesInMemoryDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use UsesInMemoryDatabase;

    public function setUp()
    {
        var_dump($_ENV);

        parent::setUp();

        $this->setUpDatabase();

        $this->artisan('db:seed', ['--class' => ArticleSeeder::class]);
    }
}
