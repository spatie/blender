<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        $logItems = $this->getLatestActivityItems();

        $view = view('back.dashboard.index')->with(compact('logItems'));

        if (empty(config('laravel-analytics.siteId'))) {
            return $view;
        }

        $analyticsData = $this->getAnalyticsData();

        $dates = $analyticsData->lists('date');
        $visitors = $analyticsData->lists('visitors');
        $pageViews = $analyticsData->lists('pageViews');

        return $view->with(compact('dates', 'visitors', 'pageViews'));
    }

    protected function getLatestActivityItems():Collection
    {
        return Activity::with('user')
            ->latest()
            ->limit(30)
            ->get();
    }

    protected function getAnalyticsData():Collection
    {
        return app('laravelAnalytics')->getVisitorsAndPageViews(14);
    }
}
