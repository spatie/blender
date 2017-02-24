<?php

namespace Tests\Features\Front;

class HomeTest extends TestCase
{
    /** @test */
    public function it_can_display_the_home_page()
    {
        $this->get('/nl');
    }
}
