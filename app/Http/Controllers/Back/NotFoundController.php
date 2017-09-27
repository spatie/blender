<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;

class NotFoundController extends Controller
{
    public function __invoke()
    {
        return view('back.errors.404');
    }
}
