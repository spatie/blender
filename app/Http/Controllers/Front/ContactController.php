<?php

namespace App\Http\Controllers\Front;

use Activity;
use App\Events\ContactFormSubmitted;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\FormResponseRequest;
use App\Models\FormResponse;
use App\Repositories\ArticleRepository;

class ContactController extends Controller
{
    /**
     * @param \App\Repositories\ArticleRepository $articleRepository
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ArticleRepository $articleRepository)
    {
        $article = $articleRepository->findByTechnicalName('contact');

        $data = compact('article');

        return view('front.contact.index', $data);
    }

    /**
     * @param \App\Http\Requests\Front\FormResponseRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleResponse(FormResponseRequest $request)
    {
        $formResponse = FormResponse::create($request->all());

        event(new ContactFormSubmitted($formResponse));

        Activity::log($request->get('email').' vulde het contactformulier in');

        flash()->success(fragment('contact.response'));

        return redirect()->action('Front\ContactController@index');
    }
}
