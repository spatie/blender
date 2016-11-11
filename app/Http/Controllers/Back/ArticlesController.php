<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Back\ArticleRequest;
use App\Models\Article;
use App\Models\Enums\SpecialArticle;
use App\Repositories\ArticleRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Blender\Model\Controller;

class ArticlesController extends Controller
{
    protected function make(): Article
    {
        return Article::create();
    }

    protected function updateFromRequest(Article $article, ArticleRequest $request)
    {
        $article->parent_id = $request->get('parent_id') ?: null;

        $article->syncContentBlocks($request);

        $this->updateModel($article, $request);
    }

    protected function updateOnlineToggle(Model $model, FormRequest $request)
    {
        if ($model->isSpecialArticle()) {
            $model->online = true;

            return;
        }

        parent::updateOnlineToggle($model, $request);
    }

    public function edit(int $id)
    {
        $parentMenuItems = ArticleRepository::getTopLevel()
            ->filter(function (Article $article) {
                return $article->technical_name != SpecialArticle::HOME;
            })
            ->pluck('name', 'id')
            ->prepend('Geen', 0);

        return parent::edit($id)->with(compact('parentMenuItems'));
    }
}
