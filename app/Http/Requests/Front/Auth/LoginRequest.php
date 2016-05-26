<?php

namespace App\Http\Requests\Front\Auth;

use App\Http\Requests\Request;

class LoginRequest extends Request
{
    public function rules():array
    {
        return [
            'email' => 'required|email|exists:users_front,email',
            'password' => 'required',
        ];
    }
}
