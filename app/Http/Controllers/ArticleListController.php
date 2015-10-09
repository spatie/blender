<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;

class ArticleListController extends Controller
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = $this->articleRepository->findByTechnicalNameOrAbort($this->getTechnicalName());

        return view("front.{$this->getViewFolderName()}.index")->with(compact('article'));
    }

    public function getTechnicalName()
    {
        return app()->router->getCurrentRoute()->getName();
    }

    public function getViewFolderName()
    {
        return explode('.', app()->router->getCurrentRoute()->getName())[0];
    }
}
