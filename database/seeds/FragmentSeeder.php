<?php

use App\Models\Fragment;
use App\Models\Translations\FragmentTranslation;
use Spatie\Seeders\FragmentFactory;

class FragmentSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new FragmentTranslation())->getTable(), (new Fragment())->getTable());

        $this->superSeeder(new FragmentFactory(Fragment::class), 'fragments');
    }

    public function softRun()
    {
        $this->run();

        Cache::flush();
    }

    public function seedRandomFragments($amount = 10)
    {
        return factory(Fragment::class, $amount)
            ->create()
            ->each(function ($fragment) {
                foreach (config('app.locales') as $locale) {
                    $translation = factory(FragmentTranslation::class)->make(['locale' => $locale]);
                    $fragment->translations()->save($translation);
                }
            })
            ->load('translations');
    }
}
