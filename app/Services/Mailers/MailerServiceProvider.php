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
        $events->subscribe(AdminMailer::class);
        $events->subscribe(MemberMailer::class);
    }
}
