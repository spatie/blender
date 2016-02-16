<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\Request;

class BackUserRequest extends Request
{
    public function rules() : array
    {
        $rules = [
            'email' => 'required|email|unique:users_back,email',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'confirmed',
        ];

        if ($this->method() === 'PATCH') {
            $rules['email'] .= ",{$this->getRouteParameter('backUsers')}";
        }

        return $rules;
    }
}
