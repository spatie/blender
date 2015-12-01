<?php

namespace App\Test\Integration\Back;

use App\Models\Article;
use ArticleSeeder;

class ArticleTest extends ModuleTestCase
{
    protected $name = 'article';
    protected $pluralName = 'articles';
    protected $controller = 'Back\ArticleController';
    protected $expectedProperties = [
        'id',
        'name',
        'url',
        'text',
    ];

    public function setUp()
    {
        parent::setUp();

        $this->models = (new ArticleSeeder())->seedRandomArticles(10);
    }
}
