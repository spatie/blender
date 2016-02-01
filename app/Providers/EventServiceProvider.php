<?php

namespace App\Providers;

use App\Services\Mailers\AdminMailerEventHandler;
use App\Services\Mailers\MemberMailerEventHandler;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $subscribe = [
        AdminMailerEventHandler::class,
        MemberMailerEventHandler::class,
    ];
}
