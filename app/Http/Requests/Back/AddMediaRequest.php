<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class AddMediaRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            'collection' => 'required',
            'file' => 'required|max:'.config('mediaLibrary.maxFileSize'),
        ];

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        return response()->json($validator->messages(), 400);
    }
}
