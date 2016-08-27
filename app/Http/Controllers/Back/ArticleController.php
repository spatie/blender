<?php

namespace App\Http\Controllers\Back;

use App\Models\Article;
use App\Models\Enums\SpecialArticle;
use App\Repositories\ArticleRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArticleController extends ModuleController
{
    protected $modelName = 'Article';
    protected $moduleName = 'articles';

    protected function make()
    {
        $model = new Article();
        $model->save();

        return $model;
    }

    public function edit(Request $request, int $id)
    {
        $model = $this->find($id);

        if ($request->has('revert')) {
            $model->clearTemporaryMedia();

            return redirect()->action("Back\\{$this->modelName}Controller@edit", [$id]);
        }

        $data = [
            'model' => $model,
            'module' => $this->moduleName,
            'parentMenuItems' => app(ArticleRepository::class)
                ->getTopLevel()
                ->filter(function (Article $article) {
                    return $article->technical_name != SpecialArticle::HOME;
                })
                ->pluck('name', 'id')
                ->prepend('Geen', 0)
                ->toArray(),
        ];

        return view("back.{$this->moduleName}.edit", $data);
    }
}
