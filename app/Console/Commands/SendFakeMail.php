<?php

namespace App\Console\Commands;

use App\Services\MailableFactory;
use Exception;
use Illuminate\Console\Command;
use Mail;

class SendFakeMail extends Command
{
    protected $signature = 'mail:fake {mailableClass} {recipient}';

    protected $description = 'Clear a Beanstalkd queue, by deleting all pending jobs.';

    public function handle()
    {
        $this->guardAgainstInvalidArguments();

        $mailable = MailableFactory::create($this->argument('mailableClass'));

        Mail::to('freek@spatie.be')->send($mailable);

        $this->comment('Mail sent!');
    }

    public function guardAgainstInvalidArguments(): void
    {
        if (! validate($this->argument('recipient'), 'email')) {
            throw new Exception("`{$this->argument('recipient')}` is not a valid e-mail address");
        }
    }
}
