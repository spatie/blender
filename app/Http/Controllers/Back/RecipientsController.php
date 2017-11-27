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

    public function edit(int $id)
    {
        $formTypes = config('forms.types');

        return parent::edit($id)->with(compact('formTypes'));
    }

    protected function updateFromRequest(Recipient $model, Request $request)
    {
        $this->updateFields($model, $request, ['name', 'form', 'email']);
        $model->save();
    }

    protected function validationRules(): array
    {
        return [
            'name' => 'required',
            'form' => 'required',
            'email' => 'required|email',
        ];
    }
}
