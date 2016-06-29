<?php

namespace App\Http\Controllers\Back;

use Analytics;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Spatie\Activitylog\Models\Activity;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{
    public function index()
    {
        $logItems = $this->getLatestActivityItems();

        $view = view('back.dashboard.index')->with(compact('logItems'));

        if (empty(config('laravel-analytics.view_id'))) {
            return $view;
        }

        $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(14));

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
