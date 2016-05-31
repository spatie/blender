<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\Request;

class TagRequest extends Request
{
    public function rules(): array
    {
        $rules = [];

        foreach (config('app.locales') as $locale) {
            $rules[translate_field_name('name', $locale)] = 'required';
        }

        return $rules;
    }
}
