<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class NotFoundController extends Controller
{
    public function __invoke()
    {
        return view('errors.404');
    }
}
