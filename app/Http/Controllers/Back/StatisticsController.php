<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use LaravelAnalytics;

class StatisticsController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (config('laravel-analytics.siteId') == '') {
            return view('back.statistics.notconfigured');
        }

        $visitorsData = LaravelAnalytics::getVisitorsAndPageViews(365, 'yearMonth');
        $pagesData = LaravelAnalytics::getMostVisitedPages();
        $keywordData = LaravelAnalytics::getTopKeywords();
        $referrerData = LaravelAnalytics::getTopReferrers();
        $browserData = LaravelAnalytics::getTopBrowsers();

        return view('back.statistics.index')
            ->with(compact('visitorsData', 'pagesData', 'keywordData', 'referrerData', 'browserData'));
    }
}
