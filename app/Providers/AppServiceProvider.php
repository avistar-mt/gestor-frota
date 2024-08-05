<?php

namespace App\Providers;

use App\Models\Checkin;
use Illuminate\Support\ServiceProvider;
use App\Observers\CheckinObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Checkin::observe(CheckinObserver::class);
    }
}
