<?php

namespace App\Test\Integration\Back;

use NewsItemSeeder;

class NewsItemTest extends ModuleTestCase
{
    protected $name = 'newsItem';
    protected $pluralName = 'newsItems';
    protected $controller = 'Back\NewsItemController';
    protected $expectedProperties = [
        'id',
        'name',
        'url',
    ];

    public function setUp()
    {
        parent::setUp();

        $this->models = (new NewsItemSeeder())->seedRandomNewsItems(10);
    }
}
