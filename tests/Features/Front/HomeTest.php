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
}
