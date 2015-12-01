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
        $model = "\\App\\Models\\{$this->modelName}";

        $model::setNewOrder($request->get('ids'));
    }
}
