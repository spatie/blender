<?php

use Spatie\Seeders\DatabaseSeeder as Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        parent::run();

        $this->call(FragmentSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(PersonSeeder::class);
        $this->call(NewsItemSeeder::class);
    }
}
