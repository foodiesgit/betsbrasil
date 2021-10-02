<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events;
use App\Observers\EventObserver;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Events::observe(EventObserver::class);
        \Schema::defaultStringLength(191);
    }
}
