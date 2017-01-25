<?php

namespace App\Console\Commands;

use App\Services\MailableFactory;
use Exception;
use Illuminate\Console\Command;
use Mail;

class SendTestMail extends Command
{
    protected $signature = 'mail:fake {mailableClass} {recipient}';

    protected $description = 'Send a test email';

    public function handle()
    {
        $this->guardAgainstInvalidArguments();

        $mailable = MailableFactory::create($this->argument('mailableClass'));

        Mail::to($this->argument('recipient'))->send($mailable);

        $this->comment('Mail sent!');
    }

    public function guardAgainstInvalidArguments(): void
    {
        if (! validate($this->argument('recipient'), 'email')) {
            throw new Exception("`{$this->argument('recipient')}` is not a valid e-mail address");
        }
    }
}
