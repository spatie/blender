<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Spatie\Backup\Commands\BackupCommand;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\GenerateModule::class,
        \App\Console\Commands\ImportFragments::class,
        \App\Console\Commands\PrefetchAnalyticsData::class,
        \Spatie\ArtisanDd\DdCommand::class,
        \Spatie\LinkChecker\CheckLinksCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('horizon:snapshot')->everyFiveMinutes();
        $schedule->command(BackupCommand::class)->dailyAt('03:00');
        $schedule->command(BackupCommand::class, ['--only-db'])->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     */
    protected function commands()
    {
        //require base_path('routes/console.php');
    }
}
