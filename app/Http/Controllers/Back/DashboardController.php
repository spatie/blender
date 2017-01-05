<?php

namespace App\Http\Controllers\Back;

use Analytics;
use Spatie\Analytics\Period;
use Illuminate\Support\Collection;
use Spatie\Activitylog\Models\Activity;

class DashboardController
{
    public function index()
    {
        $logItems = $this->getLatestActivityItems();

        $view = view('back.dashboard.index')->with(compact('logItems'));

        if (empty(config('laravel-analytics.view_id'))) {
            return $view;
        }

        $analyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::days(14));

        $dates = $analyticsData->pluck('date');
        $visitors = $analyticsData->pluck('visitors');
        $pageViews = $analyticsData->pluck('pageViews');

        return $view->with(compact('dates', 'visitors', 'pageViews'));
    }

    protected function getLatestActivityItems(): Collection
    {
        return Activity::with('causer')
            ->latest()
            ->limit(30)
            ->get();
    }
}
