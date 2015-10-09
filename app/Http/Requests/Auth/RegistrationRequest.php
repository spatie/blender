<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegistrationRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =
            [
                'email' => 'required|email|unique:users',
                'first_name' => 'required',
                'last_name' => 'required',
                'password' => 'min:8|confirmed',
            ];

        return $rules;
    }
}
