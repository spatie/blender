<?php

use App\Models\NewsItem;
use App\Models\Translations\NewsItemTranslation;

class NewsItemSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new NewsItemTranslation())->getTable(), (new NewsItem())->getTable());

        $this->seedRandomNewsItems();
    }

    public function seedRandomNewsItems($amount = 10, $withMedia = true)
    {
        return factory(NewsItem::class, $amount)
            ->create()
            ->each(function ($newsItem) use ($withMedia) {
                $this->addTranslations($newsItem);

                if ($withMedia) {
                    $this->addImages($newsItem, 1, 3);
                }
            });
        ;
    }
}
