<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = article('home');

        return view('front.home.index', compact('article'));
    }
}
