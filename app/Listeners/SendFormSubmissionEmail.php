<?php

namespace App\Listeners;

use App\Events\ContactFormSubmitted;
use App\Services\Mailers\ContactFormMailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendFormSubmissionEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var \App\Services\Mailers\ContactFormMailer
     */
    protected $contactFormMailer;

    /**
     * @param \App\Services\Mailers\ContactFormMailer $contactFormMailer
     */
    public function __construct(ContactFormMailer $contactFormMailer)
    {
        $this->contactFormMailer = $contactFormMailer;
    }

    /**
     * @param \App\Events\ContactFormSubmitted $event
     */
    public function handle(ContactFormSubmitted $event)
    {
        $this->contactFormMailer->notifySiteOwner($event->formResponse->toArray());
    }
}
