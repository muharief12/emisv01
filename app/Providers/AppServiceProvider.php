<?php

namespace App\Providers;

use App\Models\EventPayment;
use App\Observers\EventPaymentObserver;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.key') === 'local') {
            URL::forceScheme('https');
        }

        EventPayment::observe(EventPaymentObserver::class);
    }
}
