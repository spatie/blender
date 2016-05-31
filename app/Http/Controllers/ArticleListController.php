<?php

namespace App\Http\Controllers;

class ArticleListController extends Controller
{
    public function index()
    {
        $article = article($this->getTechnicalName());

        return view("front.{$this->getViewFolderName()}.index")->with(compact('article'));
    }

    protected function getTechnicalName(): string
    {
        return app()->router->getCurrentRoute()->getName();
    }

    protected function getViewFolderName(): string
    {
        return explode('.', app()->router->getCurrentRoute()->getName())[0];
    }
}
