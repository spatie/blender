<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Spatie\Activitylog\Models\Activity;

class ActivitylogController extends Controller
{
    public function index()
    {
        $logItems = $this->getPaginatedActivityLogItems();

        return view('back.activitylog.index')->with(compact('logItems'));
    }

    protected function getPaginatedActivityLogItems() : Collection
    {
        return Activity::with('user')
            ->orderBy('created_at', 'DESC')
            ->paginate(50);
    }
}
