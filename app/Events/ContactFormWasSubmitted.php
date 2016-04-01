<?php

namespace App\Events;

use App\Models\FormResponse;

class ContactFormWasSubmitted extends Event
{
    /** @var \App\Models\FormResponse */
    public $formResponse;

    public function __construct(FormResponse $formResponse)
    {
        $this->formResponse = $formResponse->fresh();
    }
}
