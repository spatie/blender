<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Repositories\ActivityRepository;

class ActivitylogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ActivityRepository $activityRepository
     *
     * @return Response
     */
    public function index(ActivityRepository $activityRepository)
    {
        $logItems = $activityRepository->getPaginator(50);

        return view('back.activitylog.index')->with(compact('logItems'));
    }
}
