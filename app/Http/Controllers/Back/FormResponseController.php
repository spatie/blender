<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\FormResponse;

class FormResponseController extends Controller
{
    public function showDownloadButton()
    {
        return view('back.formResponse.index');
    }

    public function download()
    {
        FormResponse::downloadAll();
    }
}
