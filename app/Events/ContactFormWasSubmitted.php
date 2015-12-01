<?php

namespace App\Events;

use App\Models\FormResponse;

class ContactFormWasSubmitted extends Event
{
    /**
     * @var \App\Models\FormResponse
     */
    public $formResponse;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\FormResponse $formResponse
     */
    public function __construct(FormResponse $formResponse)
    {
        $this->formResponse = FormResponse::findOrFail($formResponse->id);
    }
}
