<?php

namespace Tests\Browser\Front;

use Laravel\Dusk\Browser;
use Tests\Browser\TestCase;

class HomeTest extends TestCase
{
    /** @test */
    public function it_can_display_the_home_page()
    {
        $article = article('home');

        $this->browse(function (Browser $browser) use ($article) {
            $browser
                ->visit('/nl')
                ->assertSee($article->name);
        });
    }
}
