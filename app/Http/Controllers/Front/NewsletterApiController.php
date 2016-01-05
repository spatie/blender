<?php

namespace App\Http\Controllers\Front;

use Activity;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Front\NewsletterSubscriptionRequest;
use Exception;
use Log;
use Spatie\Newsletter\Exceptions\AlreadySubscribed;
use Spatie\Newsletter\Exceptions\ServiceRefusedSubscription;
use Spatie\Newsletter\Interfaces\NewsletterInterface;
use Spatie\Newsletter\Newsletter;

class NewsletterApiController extends ApiController
{
    /**
     * @var Spatie\Newsletter\Interfaces\NewsletterInterface
     */
    protected $newsletter;

    public function __construct(NewsletterInterface $newsLetter)
    {
        $this->newsletter = $newsLetter;
    }

    /**
     * @param \App\Http\Requests\Front\NewsletterSubscriptionRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(NewsletterSubscriptionRequest $request)
    {
        try {
            $this->newsletter->subscribe($request->get('email'));
            Activity::log($request->get('email').' schreef zich in op de nieuwsbrief.');
        } catch (AlreadySubscribed $exception) {
            return $this->respond(['message' => fragment('newsletter.subscription.result.alreadySubscribed'), 'type' => 'info']);
        } catch (ServiceRefusedSubscription $exception) {
            return $this->respondWithBadRequest(['message' => fragment('newsletter.subscription.result.error'), 'type' => 'error']);
        } catch (Exception $e) {
            Log::error('newsletter subscription failed with exception message: '.$e->getMessage());

            return $this->respondWithInternalServerError(['message' => fragment('newsletter.subscription.result.error'), 'type' => 'error']);
        }

        return $this->respond(['message' => fragment('newsletter.subscription.result.ok'), 'type' => 'success']);
    }
}
