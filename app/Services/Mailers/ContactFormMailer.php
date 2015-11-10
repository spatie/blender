<?php

namespace App\Services\Mailers;

use Request;
use Log;

class ContactFormMailer extends Mailer
{
    public function notifySiteOwner($formValues)
    {
        $view = 'emails.contactFormSubmitted';
        $data = $formValues;
        $subject = 'Een nieuwe reactie op '.Request::server('SERVER_NAME');

        foreach (config('mail.questionFormRecipients') as $email) {
            Log::info('mail naar '.$email.' met inhoud '.print_r($formValues, true));
            $this->sendTo($email, $subject, $view, $data);
        }
    }
}
