<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class NotFoundController extends Controller
{
    public function __invoke()
    {
        return response()->view('front.errors.404', [], 404);
    }
}
