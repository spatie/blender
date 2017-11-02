<?php

use Spatie\Seeders\DatabaseSeeder as Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        parent::run();

        Cache::flush();

        $this->call(BackUserSeeder::class);
        $this->call(FrontUserSeeder::class);
        $this->call(FragmentSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(PersonSeeder::class);
        $this->call(NewsItemSeeder::class);
        $this->call(RecipientSeeder::class);
    }

    protected function times(int $times, callable $callback)
    {
        foreach (range(0, $times) as $i) {
            $callback();
        }
    }
}
