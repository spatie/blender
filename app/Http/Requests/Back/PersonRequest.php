<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\Request;

class PersonRequest extends Request
{
    public function rules() : array
    {
        return [
            'name' => 'required',
        ];
    }
}
