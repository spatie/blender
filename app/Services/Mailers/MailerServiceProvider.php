<?php

namespace App\Services\Mailers;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

class MailerServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot(Dispatcher $events)
    {
        $events->subscribe(AdminMailerEventHandler::class);
        $events->subscribe(ContactFormMailerEventHandler::class);
        $events->subscribe(MemberMailerEventHandler::class);
    }
}
