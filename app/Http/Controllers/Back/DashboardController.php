<?php

namespace App\Http\Controllers\Back;

use Analytics;
use Illuminate\Support\Collection;
use Spatie\Activitylog\Models\Activity;
use Spatie\Analytics\Period;

class DashboardController
{
    public function index()
    {
        $logItems = $this->getLatestActivityItems();

        $view = view('back.dashboard.index')->with(compact('logItems'));

        if (empty(config('analytics.view_id'))) {
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
