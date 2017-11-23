<?php

namespace App\Http\Controllers\Back;

use App\Models\Recipient;
use Illuminate\Http\Request;

class RecipientsController extends Controller
{
    protected function make(): Recipient
    {
        return Recipient::create();
    }

    protected function updateFromRequest(Recipient $model, Request $request)
    {
        $this->updateFields($model, $request, ['form', 'email']);
        $model->save();
    }

    protected function validationRules(): array
    {
        return [
            'form' => 'required',
            'email' => 'required|email',
        ];
    }
}
