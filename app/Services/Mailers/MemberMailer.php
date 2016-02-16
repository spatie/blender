<?php

namespace App\Services\Mailers;

use App\Services\Auth\Front\User;
use Illuminate\Mail\Message;
use Password;

class MemberMailer extends Mailer
{
    public function sendWelcomeMail(User $user)
    {
        $view = 'emails.auth.front.welcome';
        $data = ['userId' => $user->id];
        $subject = 'Welkom bij '.request()->getHost();

        $this->sendTo($user->email, $subject, $view, $data);
    }

    public function sendPasswordEmail(User $user)
    {
        Password::broker('front')->sendResetLink(['email' => $user->email], function (Message $message) {
            $message->subject('Welkom bij '.request()->getHost());
        });
    }
}
