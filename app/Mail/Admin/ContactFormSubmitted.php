<?php

namespace App\Mail\Admin;

use App\Models\FormResponse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @var \App\Models\FormResponse */
    public $formResponse;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\FormResponse $formResponse
     */
    public function __construct(FormResponse $formResponse)
    {
        $this->formResponse = $formResponse;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to(recipients('contactForm'))
            ->subject('Een nieuwe reactie op '.config('app.url'))
            ->markdown('mails.admin.contactFormSubmitted');
    }
}
