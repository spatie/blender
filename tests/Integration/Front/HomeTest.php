<?php

namespace App\Test\Integration\Front;

use App\Test\Integration\TestCase;

class HomeTest extends TestCase
{
    /** @test */
    public function it_can_display_the_home_page()
    {
        $this
            ->visit('/')
            ->assertResponseOk();
    }
}
