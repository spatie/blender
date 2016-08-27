<?php

namespace App\Http\Controllers\Front\Api;

use Newsletter;
use App\Http\Requests\Front\Api\NewsletterSubscriptionRequest;

class NewsletterController extends Controller
{
    /**
     * @param \App\Http\Requests\Front\NewsletterSubscriptionRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(NewsletterSubscriptionRequest $request)
    {
        $email = strtolower($request->get('email'));

        if (Newsletter::hasMember($email)) {
            return $this->respond(['message' => fragment('newsletter.subscription.result.alreadySubscribed'), 'type' => 'info']);
        }

        $result = Newsletter::subscribe($email);

        if (!$result) {
            return $this->respondWithBadRequest(['message' => fragment('newsletter.subscription.result.error'), 'type' => 'error']);
        }

        activity()->log("{$email} schreef zich in op de nieuwsbrief");

        return $this->respond(['message' => fragment('newsletter.subscription.result.ok'), 'type' => 'success']);
    }
}
