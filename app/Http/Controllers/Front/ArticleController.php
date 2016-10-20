<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;

class ArticleController extends Controller
{
    public function index(...$articleUrls)
    {
        $articleUrl = collect($articleUrls)->last();

        $article = ArticleRepository::findByUrl($articleUrl);

        if ($article->hasChildren()) {
            return redirect($article->firstChild->fullUrl);
        }

        return view('front.article.index')->with(compact('article'));
    }
}
