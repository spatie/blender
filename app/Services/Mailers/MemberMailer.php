<?php

namespace App\Services\Mailers;

use App\Services\Auth\Front\User;

class MemberMailer extends Mailer
{
    public function sendWelcomeMail(User $user)
    {
        $view = 'emails.auth.front.welcome';
        $data = ['userId' => $user->id];
        $subject = 'Welkom bij '.request()->getHost();

        $this->sendTo($user->email, $subject, $view, $data);
    }

    public function sendApprovedMail(User $user)
    {
        $view = 'emails.auth.front.approved';
        $data = ['userId' => $user->id];
        $subject = 'Uw account is goedgekeurd';

        $this->sendTo($user->email, $subject, $view, $data);
    }
}
