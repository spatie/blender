<?php

use App\Models\Fragment;

class FragmentSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new Fragment())->getTable());

        Artisan::call('fragments:import', ['--update' => true]);
    }
}
