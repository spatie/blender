<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\FormResponseRequest;
use App\Mail\ContactFormSubmitted;
use App\Models\Enums\SpecialArticle;
use App\Models\FormResponse;
use Mail;

class ContactController extends Controller
{
    public function index()
    {
        $article = article(SpecialArticle::CONTACT());

        return view('front.contact.index', compact('article'));
    }

    public function handleResponse(FormResponseRequest $request)
    {
        $formResponse = FormResponse::create($request->except(['g-recaptcha-response']));

        Mail::send(new ContactFormSubmitted($formResponse));

        activity()->log("{$formResponse->email} vulde het contactformulier in");

        flash()->success(fragment('contact.response'));

        return redirect()->action('Front\ContactController@index');
    }
}
