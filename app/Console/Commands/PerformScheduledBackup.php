<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

class PerformScheduledBackup extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'backup:scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the scheduled backup.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('backup:run');
        Artisan::call('backup:clean');
    }
}
