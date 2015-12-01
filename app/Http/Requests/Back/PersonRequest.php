<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\Request;

class PersonRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
}
