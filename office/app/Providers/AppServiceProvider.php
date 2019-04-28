<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\CommunicationService;
use App\CommunicationServiceContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CommunicationServiceContract::class, CommunicationService::class);
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
