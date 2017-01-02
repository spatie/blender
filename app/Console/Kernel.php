<?php

namespace App\Console;

use Spatie\LinkChecker\CheckLinksCommand;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\PrefetchAnalyticsData;
use Spatie\FragmentImporter\Commands\ImportFragments;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\ClearBeanstalkdQueue::class,
        Commands\GenerateModule::class,
        CheckLinksCommand::class,
        ImportFragments::class,
        PrefetchAnalyticsData::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('backup:run')->dailyAt('03:00');
        $schedule->command('backup:clean')->dailyAt('04:00');
        $schedule->command('analytics:prefetch')->dailyAt('06:00');
        $schedule->command('link-checker:run')->monthly();
        $schedule->command('clean:models')->daily();
        $schedule->command('activity:clean')->daily();
    }

    /**
     * Register the Closure based commands for the application.
     */
    protected function commands()
    {
        //require base_path('routes/console.php');
    }
}
