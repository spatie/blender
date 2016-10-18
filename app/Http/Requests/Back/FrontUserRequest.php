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

    public function getEmailValidationRule(): Rule
    {
        $emailRule = Rule::unique('users_front', 'email');

        if ($this->method() === 'PATCH') {
            $emailRule = $emailRule->where(function ($query) {
                $query->where('email', $this->getRouteParameter('frontUser'));
            });
        }

        return $emailRule;
    }
}
