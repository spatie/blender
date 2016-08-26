<?php

namespace App\Services\Auth\Front\Mail;

use App\Services\Auth\Front\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /** @var \App\Services\Auth\Back\User */
    public $user;

    /** @var string */
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $token)
    {
        $this->user = $user;

        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Toegang tot ' . config('app.url'))
            ->view('emails.auth.front.resetPassword');
    }
}
