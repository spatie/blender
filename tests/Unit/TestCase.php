<?php

namespace Tests\Unit;

use Tests\Concerns\CreatesApplication;
use Tests\Concerns\UsesDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use UsesDatabase;

    public function setUp()
    {
        $this->prepareDatabase();

        parent::setUp();

        $this->setUpDatabase();

        $this->beginDatabaseTransaction();
    }
}
