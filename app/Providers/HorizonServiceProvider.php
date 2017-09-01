<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\Horizon;

class HorizonServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Horizon::routeMailNotificationsTo(config('horizon.email'));

        Horizon::routeSlackNotificationsTo(config('horizon.slack_webhook_url'));

        Horizon::auth(function (Request $request) {
            if (app()->environment('locale')) {
                return true;
            }

            $backUser = auth('back')->user();

            if (! $backUser) {
                return false;
            }

            return ends_with($backUser->email, '@spatie.be');
        });
    }
}
