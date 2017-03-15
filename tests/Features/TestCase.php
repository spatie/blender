<?php

namespace Tests\Features;

use Tests\Concerns\RunsSeeders;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RunsSeeders;

    public function setUp()
    {
        parent::setUp();

        $this->runSeeders();
    }
}
