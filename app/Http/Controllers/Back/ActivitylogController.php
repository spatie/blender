<?php

namespace App\Http\Controllers\Back;

use Illuminate\Contracts\Pagination\Paginator;
use Spatie\Activitylog\Models\Activity;

class ActivitylogController
{
    public function index()
    {
        $logItems = $this->getPaginatedActivityLogItems();

        return view('back.activitylog.index', compact('logItems'));
    }

    protected function getPaginatedActivityLogItems(): Paginator
    {
        return Activity::with('causer')
            ->orderBy('created_at', 'DESC')
            ->paginate(50);
    }
}
