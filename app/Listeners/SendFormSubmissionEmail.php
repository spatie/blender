<?php

namespace App\Listeners;

use App\Events\ContactFormSubmitted;
use App\Mailers\ContactFormMailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendFormSubmissionEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var \App\Mailers\ContactFormMailer
     */
    protected $contactFormMailer;

    /**
     * @param \App\Mailers\ContactFormMailer $contactFormMailer
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
