<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Laravel\Horizon\Horizon;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();

        // Horizon::routeSmsNotificationsTo('15556667777');
        // Horizon::routeMailNotificationsTo('example@example.com');
        // Horizon::routeSlackNotificationsTo('slack-webhook-url', '#channel');
    }

    /**
     * Register the Horizon gate.
     *
     * This gate determines who can access Horizon in non-local environments.
     */
    protected function gate(): void
    {
        $admins = env('ADMIN_EMAILS', '');
        $emailArray = array_filter(array_map('trim', explode(',', $admins)));
        Log::info('Admin emails:', $emailArray);
        Gate::define('viewHorizon', function ($user) use($emailArray) {
         //   Log::info('Logged in User:', $user->email);
            return true;//in_array($user->email, $emailArray);
        });
    }
}
