<?php

namespace App\Services\Mailers;

use App\Services\Auth\Front\User;

class MemberMailer extends Mailer
{
    public function sendApprovedMail(User $user)
    {
        $view = 'emails.member.approved';
        $data = ['userId' => $user->id];
        $subject = 'Uw account is goedgekeurd';

        $this->sendTo($user->email, $subject, $view, $data);
    }
}
