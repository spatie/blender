<?php

namespace App\Http\Controllers\Front\Api;

use App\Http\Requests\Front\Api\NewsletterSubscriptionRequest;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class NewsletterController extends Controller
{
    public function subscribe(NewsletterSubscriptionRequest $request)
    {
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
}
