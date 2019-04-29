<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\CommunicationServiceContract;
use App\CommunicationService;
use GuzzleHttp\Client;

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

        $this->app->bind(Client::class, function () {
            return new Client([
                'base_uri' => env('OFFICE_API_URL'),
                'headers'  => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json',
                ]
            ]);
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
