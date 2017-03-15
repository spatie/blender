<?php

namespace Tests\Features\Front;

class HomeTest extends TestCase
{
    /** @test */
    public function it_can_display_the_home_page()
    {
        $article = article('home');

        $this->get('/nl')
             ->assertSee($article->name)
             ->assertSee($article->text);
    }

    /** @test */
    public function it_can_display_the_home_page2()
    {
        $this->get('/nl');
    }

    /** @test */
    public function it_can_display_the_home_page3()
    {
        $this->get('/nl');
    }

    /** @test */
    public function it_can_display_the_home_page4()
    {
        $this->get('/nl');
    }

    /** @test */
    public function it_can_display_the_home_page5()
    {
        $this->get('/nl');
    }
}
