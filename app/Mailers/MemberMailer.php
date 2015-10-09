<?php

namespace App\Mailers;

use App\Models\User;

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
