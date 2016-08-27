<?php

namespace App\Console;

use App\Console\Commands\PrefetchAnalyticsData;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Spatie\FragmentImporter\Commands\ImportFragments;
use Spatie\LinkChecker\CheckLinksCommand;

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
        Commands\PerformScheduledBackup::class,
        Commands\SendSlackMessage::class,
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
        $schedule->command('backup:scheduled')->dailyAt('03:00');
        $schedule->command('analytics:prefetch')->dailyAt('06:00');
        $schedule->command('link-checker:run')->monthly();
        $schedule->command('clean:models')->daily();
        $schedule->command('activity:clean')->daily();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        //require base_path('routes/console.php');
    }
}
