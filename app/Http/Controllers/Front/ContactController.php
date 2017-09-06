<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\Admin\ContactFormSubmitted;
use App\Models\Enums\SpecialArticle;
use App\Models\FormResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $article = article(SpecialArticle::CONTACT);

        return view('front.contact.index', compact('article'));
    }

    public function handleResponse(Request $request)
    {
        $validatedAttributes = $request->validate([
            'name' => 'required',
            'telephone' => 'required',
            'email' => 'required|email',
            //'g-recaptcha-response' => 'required|recaptcha'
        ]);

        $formResponse = FormResponse::create($validatedAttributes);

        Mail::send(new ContactFormSubmitted($formResponse));

        activity()->log("{$formResponse->email} vulde het contactformulier in");

        flash()->success(__('contact.response'));

        return redirect()->action('Front\ContactController@index');
    }
}
