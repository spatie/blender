<?php

namespace App\Http\Requests\Front;

use App\Http\Requests\Request;

class FormResponseRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return
            [
                'name' => 'required',
                'telephone' => 'required',
                'email' => 'required|email',
                //'g-recaptcha-response' => 'required|recaptcha'
            ];
    }
}
