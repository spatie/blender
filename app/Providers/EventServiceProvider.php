<?php

namespace App\Providers;

use App\Services\Mailers\AdminMailerEventHandler;
use App\Services\Mailers\MemberMailerEventHandler;
use App\Services\Medialibrary\MediaLibraryEventHandler;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $subscribe = [
        AdminMailerEventHandler::class,
        MemberMailerEventHandler::class,
        MediaLibraryEventHandler::class,
    ];
}
