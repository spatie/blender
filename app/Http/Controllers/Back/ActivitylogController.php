<?php

namespace App\Http\Controllers\Back;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Contracts\Pagination\Paginator;

class ActivitylogController
{
    public function index()
    {
        $logItems = $this->getPaginatedActivityLogItems();

        return view('back.activitylog.index')->with(compact('logItems'));
    }

    protected function getPaginatedActivityLogItems(): Paginator
    {
        return Activity::with('causer')
            ->orderBy('created_at', 'DESC')
            ->paginate(50);
    }
}
