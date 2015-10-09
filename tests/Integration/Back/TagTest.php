<?php

namespace App\Test\Integration\Back;

use App\Models\Tag;
use TagSeeder;

class TagTest extends ModuleTestCase
{
    protected $name = 'tag';
    protected $pluralName = 'tags';
    protected $controller = 'Back\TagController';
    protected $expectedProperties = [
        'id',
        'name',
        'url',
    ];

    public function setUp()
    {
        parent::setUp();

        $this->models = $this->app->make(TagSeeder::class)->seedRandomTags(10);
    }
}
