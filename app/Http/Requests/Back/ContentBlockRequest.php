<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class AddContentBlockRequest extends Request
{
    public function rules(): array
    {
        return [
            'model_name' => 'required',
            'model_id' => 'required',
            'collection_name' => 'required',
        ];

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        return response()->json($validator->messages(), 400);
    }
}
