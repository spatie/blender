<?php

namespace App\Http\Controllers\Front;

use App\Events\ContactFormWasSubmitted;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\FormResponseRequest;
use App\Models\FormResponse;

class ContactController extends Controller
{
    public function index()
    {
        $article = article('contact');

        return view('front.contact.index', compact('article'));
    }

    public function handleResponse(FormResponseRequest $request)
    {
        $formResponse = FormResponse::create($request->all());

        event(new ContactFormWasSubmitted($formResponse));

        app('activity')->log($request->get('email').' vulde het contactformulier in');

        flash()->success(fragment('contact.response'));

        return redirect()->action('Front\ContactController@index');
    }
}
