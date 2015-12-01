<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\Request;

class ArticleRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_published' => 'date_format:'.config('date.defaultFormat'),
        ];
    }
}
