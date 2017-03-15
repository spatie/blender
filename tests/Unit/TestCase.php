<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Concerns\CreatesApplication;
use Tests\Concerns\UsesInMemoryDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use UsesInMemoryDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->setUpDatabase();
    }
}
