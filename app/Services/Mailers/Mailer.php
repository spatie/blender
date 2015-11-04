<?php

namespace App\Services\Mailers;

use Illuminate\Mail\Mailer as Mail;
use Traversable;

abstract class Mailer
{
    /**
     * @var Mail
     */
    private $mail;

    /**
     * @param Mail $mail
     */
    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Send an email.
     *
     * @param Traversable|string $email
     * @param $subject
     * @param $view
     * @param $data
     */
    public function sendTo($email, $subject, $view, $data = [])
    {
        if (!$email instanceof Traversable) {
            $email = [$email];
        }

        foreach ($email as $singleEmailAddress) {
            $this->mail->queue($view, $data, function ($message) use ($singleEmailAddress, $subject) {
                $message->to($singleEmailAddress)->subject($subject);
            });
        }
    }
}
