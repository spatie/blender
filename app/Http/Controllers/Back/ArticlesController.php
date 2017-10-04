<?php

namespace App\Http\Controllers\Back;

use App\Models\Article;
use App\Models\Enums\SpecialArticle;
use App\Repositories\ArticleRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    protected function make(): Article
    {
        return Article::create();
    }

    protected function updateFromRequest(Article $article, Request $request)
    {
        $article->parent_id = $request->get('parent_id') ?: null;

        $this->updateModel($article, $request);
        $article->syncContentBlocks($request);
    }

    protected function updateOnlineToggle(Model $model, Request $request)
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
            ->reject(function (Article $article) use ($id) {
                return $article->id === $id;
            })
            ->pluck('name', 'id')
            ->prepend('(None)', 0);

        return parent::edit($id)->with(compact('parentMenuItems'));
    }

    protected function validationRules(): array
    {
        return [
            'date_published' => 'date_format:'.config('date.defaultFormat'),
        ];
    }
}
