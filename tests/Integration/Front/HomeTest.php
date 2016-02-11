<?php

namespace App\Test\Integration\Front;

use Spatie\Integration\FrontTestCase;

class HomeTest extends FrontTestCase
{
    /** @test */
    public function it_can_display_the_home_page()
    {
        $this
            ->visit('/')
            ->assertResponseOk();
    }
}
