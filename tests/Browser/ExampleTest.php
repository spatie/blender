<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;

class ExampleTest extends TestCase
{
    /** @test */
    public function it_can_display_the_home_page()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/nl')
                ->assertSee('Home');
        });
    }
}
