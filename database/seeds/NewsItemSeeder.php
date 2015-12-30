<?php

use App\Models\NewsItem;
use App\Models\Translations\NewsItemTranslation;

class NewsItemSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new NewsItemTranslation())->getTable(), (new NewsItem())->getTable());

        $this->seedRandomNewsItems(20, false);
    }

    public function seedRandomNewsItems($amount = 10, $withImages = false)
    {
        return factory(NewsItem::class, $amount)
            ->create()
            ->each(function ($newsItem) use ($withImages) {
                $this->addTranslations($newsItem);
                if ($withImages) {
                    $this->addImages($newsItem, 3, 5);
                }
            });
        ;
    }
}
