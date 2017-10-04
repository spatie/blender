<?php

use App\Models\NewsItem;

class NewsItemSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new NewsItem())->getTable());

        collect()->range(0, 5)->each(function () {
            $this->createNewsItem();
        });
    }

    public function createNewsItem(array $attributes = []): NewsItem
    {
        $newsItem = NewsItem::create($attributes + [
            'name' => faker()->translate(faker()->title()),
            'text' => faker()->translate(faker()->text()),
            'meta_values' => collect([]),
            'publish_date' => faker()->futureDate(),
            'online' => faker()->mostly(),
            'draft' => false,
        ]);

        $this->addImages($newsItem, 1, 1);

        return $newsItem;
    }
}
