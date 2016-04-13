<?php

use App\Models\Article;

class ArticleSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new Article())->getTable());

        $this->seedArticle('Contact', 'contact');
    }

    public function seedArticle(string $name, string $technicalName = '') : Article
    {
        $article = factory(Article::class)->create([
            'name' => faker()->translate($name),
            'technical_name' => $technicalName ?? null,
            'online' => true,
        ]);

        $this->addImages($article);

        return $article;
    }
}
