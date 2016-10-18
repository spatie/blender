<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class BackUserRequest extends Request
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users_back,email',
            'email' => $this->getEmailValidationRule(),
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'confirmed',
        ];
    }

    public function getEmailValidationRule(): Rule
    {
        $emailRule = Rule::unique('users_back', 'email');

        if ($this->method() === 'PATCH') {
            $emailRule = $emailRule->where(function ($query) {
                $query->where('email', $this->getRouteParameter('backUser'));
            });
        }

        return $emailRule;
    }
}
