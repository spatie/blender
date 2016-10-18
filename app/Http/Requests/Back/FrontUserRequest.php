<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class FrontUserRequest extends Request
{
    public function rules(): array
    {
        return [
            'email' => $this->getEmailValidationRule(),
            'first_name' => 'required',
            'last_name' => 'required',
        ];
    }

    public function getEmailValidationRule(): string
    {
        $uniqueRule = Rule::unique('users_front', 'email');

        if ($this->method() === 'PATCH') {
            $userId = $this->getRouteParameter('member');

            $uniqueRule = $uniqueRule->ignore($userId);
        }

        return "required|email|{$uniqueRule}";
    }
}
