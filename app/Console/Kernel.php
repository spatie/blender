<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\GenerateModule::class,
        \Spatie\LinkChecker\CheckLinksCommand::class,
        \Spatie\FragmentImporter\Commands\ImportFragments::class,
        \App\Console\Commands\PrefetchAnalyticsData::class,
        \Spatie\ArtisanDd\DdCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(\Spatie\Backup\Commands\BackupCommand::class)->dailyAt('03:00');
        $schedule->command(\Spatie\Backup\Commands\BackupCommand::class, ['--only-db'])->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     */
    protected function commands()
    {
        //require base_path('routes/console.php');
    }
}
