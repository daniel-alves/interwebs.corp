<?php

namespace App\Providers;

use App\WebPage;
use App\Observers\WebPageObserver;
use Illuminate\Support\ServiceProvider;

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
        WebPage::Observe(WebPageObserver::class);
    }
}
