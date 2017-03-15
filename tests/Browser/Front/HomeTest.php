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

    /** @test */
    public function it_can_display_the_home_page2()
    {
        $article = article('home');

        $this->browse(function (Browser $browser) use ($article) {
            $browser
                ->visit('/nl')
                ->assertSee($article->name);
        });
    }

    /** @test */
    public function it_can_display_the_home_page3()
    {
        $article = article('home');

        $this->browse(function (Browser $browser) use ($article) {
            $browser
                ->visit('/nl')
                ->assertSee($article->name);
        });
    }

    /** @test */
    public function it_can_display_the_home_page4()
    {
        $article = article('home');

        $this->browse(function (Browser $browser) use ($article) {
            $browser
                ->visit('/nl')
                ->assertSee($article->name);
        });
    }

    /** @test */
    public function it_can_display_the_home_page5()
    {
        $article = article('home');

        $this->browse(function (Browser $browser) use ($article) {
            $browser
                ->visit('/nl')
                ->assertSee($article->name);
        });
    }
}
