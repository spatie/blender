<?php

namespace App\Http\Requests\Front\Api;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class NewsletterSubscriptionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return response()->json(string('newsletter.subscription.error.invalidEmail'), 400);
    }
}
