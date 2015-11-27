<?php

use App\Models\Article;
use App\Models\Translations\ArticleTranslation;
use Carbon\Carbon;

class ArticleSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new ArticleTranslation())->getTable(), (new Article())->getTable());

        $this->seedArticle('Contact', 'contact');
    }

    protected function seedArticle($name, $technicalName = '', $orderColumnValue = null)
    {
        $article = new Article();

        foreach (config('app.locales') as $locale) {
            $article->translate($locale)->name = $name;
            $article->translate($locale)->text =
                '<p class="intro">'.$this->faker->paragraph(6).'</p>'.
                '<h3>'.$this->faker->sentence(6).'</h3>'.
                '<p>'.$this->faker->paragraph(9).'</p>'.
                '<blockquote>'.$this->faker->paragraph(7).'</blockquote>'.
                '<h3>'.$this->faker->sentence(6).'</h3>'.
                '<p>'.$this->faker->paragraph(10).'</p>'.
                '<p>'.$this->faker->paragraph(8).'</p>';
        }

        $article->online = true;
        $article->technical_name = $technicalName;
        $article->draft = false;
        $article->order_column = $orderColumnValue;

        $article->push();

         $this->addImages($article);
    }

    public function seedRandomArticles($amount = 10, $withImages = false)
    {
        return factory(Article::class, $amount)
            ->create()
            ->each(function ($article) use ($withImages) {
                $this->addTranslations($article);
                if ($withImages) {
                    $this->addImages($article);
                }
            })
            ->load('translations', 'media');
    }
}
