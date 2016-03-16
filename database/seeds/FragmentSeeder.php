<?php

use App\Models\Fragment;
use App\Models\Translations\FragmentTranslation;

class FragmentSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new FragmentTranslation())->getTable(), (new Fragment())->getTable());

        Artisan::call('fragments:import --update');
    }
}
