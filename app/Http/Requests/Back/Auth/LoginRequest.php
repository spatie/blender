<?php

namespace App\Http\Requests\Back\Auth;

use App\Http\Requests\Request;

class LoginRequest extends Request
{
    public function rules() : array
    {
        return [
            'email' => 'required|email|exists:users_back,email',
            'password' => 'required',
        ];
    }
}
