<?php

use App\Models\NewsItem;

class NewsItemSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new NewsItem())->getTable());

        $this->seedRandomNewsItems();
    }

    public function seedRandomNewsItems($amount = 10)
    {
        return factory(NewsItem::class, $amount)
            ->create()
            ->each(function ($newsItem) {
                if (static::$withMedia) {
                    $this->addImages($newsItem, 1, 3);
                }
            });
    }
}
