<?php

namespace App\Providers;

use App\Services\CentralService;
use App\Services\CoopService;
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
        $this->app->bind(CoopService::class, function () {
            return new CoopService();
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
