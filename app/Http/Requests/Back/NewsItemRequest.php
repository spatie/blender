<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\Request;

class NewsItemRequest extends Request
{
    public function rules(): array
    {
        $rules = [];

        foreach (config('app.locales') as $locale) {
            $rules[translate_field_name('name', $locale)] = 'required';
            $rules[translate_field_name('text', $locale)] = 'required';
        }

        return $rules;
    }
}
