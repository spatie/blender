<?php

use App\Models\NewsItem;

class NewsItemSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new NewsItem())->getTable());

        $this->seedRandomNewsItems();
    }

    public function seedRandomNewsItems($amount = 10, $withMedia = true)
    {
        return factory(NewsItem::class, $amount)
            ->create()
            ->each(function ($newsItem) use ($withMedia) {
                if ($withMedia) {
                    $this->addImages($newsItem, 1, 3);
                }
            });
        ;
    }
}
