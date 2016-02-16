<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\Request;

class FrontUserRequest extends Request
{
    public function rules() : array
    {
        $rules = [
            'email' => 'required|email|unique:users_front,email',
            'first_name' => 'required',
            'last_name' => 'required',
        ];

        if ($this->method() === 'PATCH') {
            $rules['email'] .= ",{$this->getRouteParameter('frontUsers')}";
        }

        return $rules;
    }
}
