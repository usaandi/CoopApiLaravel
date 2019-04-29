<?php

namespace App\Providers;

use App\Services\CentralService;
use App\Services\coopService;
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
        $this->app->bind(coopService::class, function () {
            return new coopService();
        });
        $this->app->bind(CentralService::class, function () {
            return new CentralService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
