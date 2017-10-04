<?php

namespace App\Http\Controllers\Front\Api;

use App\Http\Request;
use Illuminate\Validation\Validator;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = strtolower($request->get('email'));

        if (Newsletter::hasMember($email)) {
            return $this->respond(['message' => __('newsletter.subscription.result.alreadySubscribed'), 'type' => 'info']);
        }

        $result = Newsletter::subscribe($email);

        if (! $result) {
            return $this->respondWithBadRequest(['message' => __('newsletter.subscription.result.error'), 'type' => 'error']);
        }

        activity()->log("{$email} schreef zich in op de nieuwsbrief");

        return $this->respond(['message' => __('newsletter.subscription.result.ok'), 'type' => 'success']);
    }

    protected function failedValidation(Validator $validator)
    {
        return response()->json(__('newsletter.subscription.error.invalidEmail'), 400);
    }
}
