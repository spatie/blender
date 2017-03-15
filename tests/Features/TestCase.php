<?php

namespace Tests\Features;

use ArticleSeeder;
use Tests\Concerns\UsesDatabase;
use Tests\Concerns\CreatesApplication;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use UsesDatabase;

    public function setUp()
    {
        $this->prepareDatabase();

        parent::setUp();

        $this->setUpDatabase(function () {
            $this->artisan('db:seed', ['--class' => ArticleSeeder::class]);
        });

        $this->beginDatabaseTransaction();
    }
}
