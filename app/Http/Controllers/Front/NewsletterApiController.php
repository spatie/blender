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
use String;

class NewsletterApiController extends ApiController
{
    /**
     * @var Spatie\Newsletter\Interfaces\NewsletterInterface
     */
    private $newsletter;

    /**
     * @param \Spatie\Newsletter\Interfaces\NewsletterInterface $newsletter
     */
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
            return $this->respond(string('newsletter.subscription.result.alreadySubscribed'));
        } catch (ServiceRefusedSubscription $exception) {
            return $this->respondWithBadRequest(string('newsletter.subscription.result.error'));
        } catch (Exception $e) {
            Log::error('newsletter subscription failed with exception message: '.$e->getMessage());

            return $this->respondWithInternalServerError(string('newsletter.subscription.result.error'));
        }

        return $this->respond(string('newsletter.subscription.result.ok'));
    }
}
