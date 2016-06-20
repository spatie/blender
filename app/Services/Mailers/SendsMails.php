<?php

namespace App\Services\Mailers;

use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;

trait SendsMails
{
    /**
     * @param mixed $addresses
     * @param string $subject
     * @param string $view
     * @param mixed $data
     */
    public function sendMail($addresses, string $subject, string $view, $data = [])
    {
        collect($addresses)->each(function (string $email) use ($subject, $view, $data) {
            app(Mailer::class)->queue($view, $data, function (Message $message) use ($email, $subject) {
                $message->to($email)->subject($subject);
            });
        });
    }
}
