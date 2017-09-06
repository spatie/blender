<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class PrefetchAnalyticsData extends Command
{
    protected $signature = 'analytics:prefetch';

    protected $description = 'Prefetch the analytics data.';

    public function handle()
    {
        $this->info('Prefetching analytics data...');

        if (empty(config('analytics.view_id'))) {
            $this->warn('No view id configured!');

            return;
        }

        Analytics::fetchTotalVisitorsAndPageViews(Period::days(14));
        Analytics::fetchTotalVisitorsAndPageViews(Period::days(365));
        Analytics::fetchMostVisitedPages(Period::days(365));
        Analytics::fetchTopReferrers(Period::days(365));
        Analytics::fetchTopBrowsers(Period::days(365));

        $this->info('Analytics data prefetched!');
    }
}
