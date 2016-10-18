<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class BackUserRequest extends Request
{
    public function rules(): array
    {
        return [
            'email' => $this->getEmailValidationRule(),
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'confirmed',
        ];
    }

    public function getEmailValidationRule(): string
    {
        $uniqueRule = Rule::unique('users_back', 'email');

        if ($this->method() === 'PATCH') {
            $userId = $this->getRouteParameter('administrator');

            $uniqueRule = $uniqueRule->ignore($userId);
        }

        return "required|email|{$uniqueRule}";
    }
}
