<?php

namespace App\Services\Mailers;

use App\Models\User;
use Illuminate\Contracts\Auth\PasswordBroker;
use Lang;
use Request;

class AdminMailer extends Mailer
{
    public function sendContactFormDetails($formValues)
    {
        $view = 'emails.admin.contactFormSubmitted';
        $data = $formValues;
        $subject = 'Een nieuwe reactie op '.Request::server('SERVER_NAME');

        foreach (['freek@spatie.be'] as $email) {
            $this->sendTo($email, $subject, $view, $data);
        }
    }

    public function sendApprovalMail(User $user)
    {
        $view = 'emails.admin.userApproval';
        $data = ['userId' => $user->id];
        $subject = 'Een nieuwe gebruiker heeft zich geregistreerd';

        foreach (['freek@spatie.be']  as $email) {
            $this->sendTo($email, $subject, $view, $data);
        }
    }

    public function sendPasswordEmail(User $user)
    {
        $passwords = app(PasswordBroker::class);

        $passwords->sendResetLink(['email' => $user->email], function ($message) {
            $message->subject(Lang::get('passwords.subjectEmailNewUser', [], 'nl'));
        });
    }
}
