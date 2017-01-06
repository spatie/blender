<?php

use App\Models\Article;
use App\Models\Enums\SpecialArticle;

class ArticleSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new Article())->getTable());

        $this->seedArticle('Home', SpecialArticle::HOME);
        $this->seedArticle('Contact', SpecialArticle::CONTACT);

        $parentArticle = $this->seedArticle('Parent');

        $this->seedArticle('Child 1', null, $parentArticle);
        $this->seedArticle('Child 2', null, $parentArticle);
    }

    public function seedArticle(string $name, string $technicalName = null, Article $parentArticle = null): Article
    {
        $article = factory(Article::class)->create([
            'name' => faker()->translate($name),
            'technical_name' => $technicalName,
            'online' => true,
            'parent_id' => $parentArticle ? $parentArticle->id : null,
        ]);

        if (static::$withMedia) {
            $this->addImages($article);
        }

        return $article;
    }
}
