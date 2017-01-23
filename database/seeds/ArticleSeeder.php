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
        $this->seedArticle('Child 2', null, $parent);
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

        $this->addImages($article);

        $this->addContentBlocks($article);

        return $article;
    }
}
