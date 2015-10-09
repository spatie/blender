<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Repositories\ActivityRepository;
use LaravelAnalytics;

class DashboardController extends Controller
{
    /**
     * @param \App\Repositories\ActivityRepository $activityRepository
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ActivityRepository $activityRepository)
    {
        $logItems = $activityRepository->getLatest();

        $view = view('back.dashboard.index')->with(compact('logItems'));

        if (config('laravel-analytics.siteId') == '') {
            return $view;
        }

        $analyticsData = LaravelAnalytics::getVisitorsAndPageViews(14);

        $dates = $analyticsData->lists('date')->toArray();
        $visitors = $analyticsData->lists('visitors')->toArray();
        $pageViews = $analyticsData->lists('pageViews')->toArray();

        $view = $view->with(compact('dates', 'visitors', 'pageViews'));

        return $view;
    }
}
