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
        \App\Console\Commands\ClearBeanstalkdQueue::class,
        \App\Console\Commands\GenerateModule::class,
        \Spatie\LinkChecker\CheckLinksCommand::class,
        \Spatie\FragmentImporter\Commands\ImportFragments::class,
        \App\Console\Commands\PrefetchAnalyticsData::class,
        \Spatie\MigrateFresh\Commands\MigrateFresh::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(\Spatie\Backup\Commands\BackupCommand::class)->dailyAt('03:00');
        $schedule->command(\Spatie\Backup\Commands\CleanupCommand::class)->dailyAt('04:00');
        $schedule->command(\Spatie\LinkChecker\CheckLinksCommand::class)->monthly();
        $schedule->command(\Spatie\ModelCleanup\CleanUpModelsCommand::class)->daily();
        $schedule->command(\Spatie\Activitylog\CleanActivitylogCommand::class)->daily();
        $schedule->command(\App\Console\Commands\PrefetchAnalyticsData::class)->dailyAt('06:00');
    }

    /**
     * Register the Closure based commands for the application.
     */
    protected function commands()
    {
        //require base_path('routes/console.php');
    }
}
