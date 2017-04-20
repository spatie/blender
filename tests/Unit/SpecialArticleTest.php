<?php

namespace Tests\Unit;

use App\Models\Enums\SpecialArticle;

/**
 * Class SpecialArticleTest
 * 
 * @package Tests\Unit
 */
class SpecialArticleTest extends TestCase
{
    /** @test */
    public function it_retrieves_the_default_value()
    {
        $this->assertEquals('home', SpecialArticle::__default);
    }
    
    /** @test */
    public function it_returns_an_array_of_values()
    {
        $this->assertTrue(is_array(SpecialArticle::__toArray()));
    }
}
