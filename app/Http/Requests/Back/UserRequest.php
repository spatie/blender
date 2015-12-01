<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\Request;

class UserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'email' => 'required|email|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'min:8|confirmed',
        ];

        if ($this->method() === 'PATCH') {
            $rules['email'] .= ',email,'.$this->getRouteParameter('user');
        }

        return $rules;
    }
}
