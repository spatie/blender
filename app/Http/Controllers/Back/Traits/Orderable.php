<?php

namespace App\Http\Controllers\Back\Traits;

use Illuminate\Http\Request;

trait Orderable
{
    /**
     * Change the order of the items.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function changeOrder(Request $request)
    {
        $this->repository->setNewOrder($request->get('ids'));
    }
}
