<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class AddMediaRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'collection' => 'required',
            'file' => 'required|max:'.config('mediaLibrary.maxFileSize'),
        ];

        return $rules;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param $validator
     *
     * @return mixed
     */
    protected function failedValidation(Validator $validator)
    {
        return response()->json($validator->messages(), 400);
    }
}
