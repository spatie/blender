<?php

use App\Models\Article;

class ArticleSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate(Article::class);

        collect([
            ['Home', 'home'],
            ['Contact', 'contact'],
        ])->each(function ($attributes) {
            $this->seedArticle(...$attributes);
        });

        $parent = $this->seedArticle('Parent');

        $this->seedArticle('Child 1', null, $parent);
    }

    public function seedArticle(string $name, string $technicalName = null, Article $parent = null): Article
    {
        $article = Article::create([
            'name' => faker()->translate($name),
            'technical_name' => $technicalName,
            'text' => faker()->translate(faker()->text()),
            'online' => true,
            'draft' => false,
            'parent_id' => $parent ? $parent->id : null,
        ]);

        // Articles are sometimes required to get our site up and running,
        // which means this seeder sometimes gets run in test scenarios.
        // to speed up our tests, we're going to disables image and content
        // blocks seeding when testing.

        if (! app()->environment('testing')) {
            $this->addImages($article);
            //$this->addContentBlocks($article);
        }

        return $article;
    }
}
