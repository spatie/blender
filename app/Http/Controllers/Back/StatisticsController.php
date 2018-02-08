<?php

namespace App\Http\Controllers\Back;

use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class StatisticsController
{
    public function index()
    {
        if (empty(config('analytics.view_id'))) {
            return view('back.statistics.notConfigured');
        }

        $visitors = Analytics::fetchTotalVisitorsAndPageViews(Period::days(365))
            ->groupBy(function (array $visitorStatistics) {
                return $visitorStatistics['date']->format('Y-m');
            })
            ->map(function ($visitorStatistics, $yearMonth) {
                list($year, $month) = explode('-', $yearMonth);

                return [
                    'date' => "{$month}-{$year}",
                    'visitors' => $visitorStatistics->sum('visitors'),
                    'pageViews' => $visitorStatistics->sum('pageViews'),
                ];
            })
            ->values();

        $pages = Analytics::fetchMostVisitedPages(Period::days(365));
        $referrers = Analytics::fetchTopReferrers(Period::days(365));
        $browsers = Analytics::fetchTopBrowsers(Period::days(365));

        return view(
            'back.statistics.index',
            compact(
                'visitors',
                'pages',
                'referrers',
                'browsers'
            )
        );
    }
}
