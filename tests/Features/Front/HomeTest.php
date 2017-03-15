<?php

namespace Tests\Features\Front;

use Tests\Features\TestCase;

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
        $article = article('home');

        $this->get('/nl')
            ->assertSee($article->name)
            ->assertSee($article->text);
    }

    /** @test */
    public function it_can_display_the_home_page3()
    {
        $article = article('home');

        $this->get('/nl')
            ->assertSee($article->name)
            ->assertSee($article->text);
    }

    /** @test */
    public function it_can_display_the_home_page4()
    {
        $article = article('home');

        $this->get('/nl')
            ->assertSee($article->name)
            ->assertSee($article->text);
    }

    /** @test */
    public function it_can_display_the_home_page5()
    {
        $article = article('home');

        $this->get('/nl')
            ->assertSee($article->name)
            ->assertSee($article->text);
    }

    /** @test */
    public function it_can_display_the_home_page6()
    {
        $article = article('home');

        $this->get('/nl')
            ->assertSee($article->name)
            ->assertSee($article->text);
    }

    /** @test */
    public function it_can_display_the_home_page7()
    {
        $article = article('home');

        $this->get('/nl')
            ->assertSee($article->name)
            ->assertSee($article->text);
    }

    /** @test */
    public function it_can_display_the_home_page8()
    {
        $article = article('home');

        $this->get('/nl')
            ->assertSee($article->name)
            ->assertSee($article->text);
    }

    /** @test */
    public function it_can_display_the_home_page9()
    {
        $article = article('home');

        $this->get('/nl')
            ->assertSee($article->name)
            ->assertSee($article->text);
    }

    /** @test */
    public function it_can_display_the_home_page10()
    {
        $article = article('home');

        $this->get('/nl')
            ->assertSee($article->name)
            ->assertSee($article->text);
    }
}
