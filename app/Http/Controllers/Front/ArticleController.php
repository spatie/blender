<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;

class ArticleController extends Controller
{
    public function index(...$articleUrls)
    {
        $articleUrl = collect($articleUrls)->last();

        /* @var $article \App\Models\Article */
        abort_unless($article = app(ArticleRepository::class)->findByUrl($articleUrl), 404);

        if ($article->hasChildren()) {
            return redirect(app(ArticleRepository::class)->firstChild($article)->fullUrl);
        }

        return view('front.article.index')->with(compact('article'));
    }
}
