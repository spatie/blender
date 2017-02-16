<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\Request;

class RedirectRequest extends Request
{
    public function rules(): array
    {
        return [
            'old_url' => 'required',
            'new_url' => 'required|different:old_url',
        ];
    }
}
