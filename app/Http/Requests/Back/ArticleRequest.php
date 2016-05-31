<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\Request;

class ArticleRequest extends Request
{
    public function rules(): array
    {
        return [
            'date_published' => 'date_format:'.config('date.defaultFormat'),
        ];
    }
}
