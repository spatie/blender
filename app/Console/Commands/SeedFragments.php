<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use FragmentSeeder;

class SeedFragments extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'seed:fragments {--overwrite}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the database fragments';

    public function handle()
    {
        if ($this->option('overwrite')) {
            $this->handleOverwrite();
            return;
        }

        (new FragmentSeeder())->softRun();

        $this->info('Fragments have been updated!');
    }

    protected function handleOverwrite()
    {
        if ( ! $this->confirm('Do you wish to continue? [y|N]')) {
            return;
        }

        (new FragmentSeeder())->run();

        $this->info('Fragments have been overwritten!');
    }
}
