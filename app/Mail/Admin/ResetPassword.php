<?php

namespace App\Mail\Admin;

use App\Models\Administrator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @var \App\Models\Administrator */
    public $user;

    /** @var string */
    public $token;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Administrator $user
     * @param string                    $token
     */
    public function __construct(Administrator $user, string $token)
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
            ->subject('🔐 Toegang tot '.config('app.url'))
            ->markdown($this->user->hasNeverLoggedIn() ? 'mails.admin.setPassword' : 'mails.admin.resetPassword');
    }
}
