<?php

namespace App\Http\Controllers\Back;

use App\Models\FormResponse;

class FormResponsesController
{
    public function showDownloadButton()
    {
        return view('back.formResponses.index');
    }

    public function download()
    {
        FormResponse::downloadAll();
    }
}
