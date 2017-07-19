<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Concerns\CreatesApplication;
use Tests\Concerns\UsesDatabase;

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
