<?php

namespace App\Models\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class TestTransformer extends TransformerAbstract
{
    public function transform(Article $article)
    {
        return [
            'id' => $article->id,
            'name' => $article->name,
        ];
    }
}
