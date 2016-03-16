<?php

namespace App\Services\Mailers;

use App\Models\FormResponse;
use App\Services\Auth\Back\User;
use Illuminate\Mail\Message;
use Password;

class AdminMailer extends Mailer
{
    public function sendContactFormDetails(FormResponse $formResponse)
    {
        $view = 'emails.admin.contactFormSubmitted';
        $data = $formResponse->toArray();
        $subject = 'Een nieuwe reactie op '.config('app.url');

        foreach (config('mail.questionFormRecipients') as $email) {
            $this->sendTo($email, $subject, $view, $data);
        }
    }

    public function sendApprovalMail(User $user)
    {
        $view = 'emails.admin.userApproval';
        $data = ['userId' => $user->id];
        $subject = 'Een nieuwe gebruiker heeft zich geregistreerd';

        foreach (['freek@spatie.be'] as $email) {
            $this->sendTo($email, $subject, $view, $data);
        }
    }

    public function sendPasswordEmail(User $user)
    {
        $passwords = Password::broker('back');

        $passwords->sendResetLink(['email' => $user->email], function (Message $message) {
            $message->subject(fragment('passwords.subjectEmailNewUser'));
        });
    }
}
