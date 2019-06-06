<?php

namespace App\Providers;

use App\CommunicationService;
use App\CommunicationServiceContract;

use Illuminate\Support\ServiceProvider;

use GuzzleHttp\Client;
use Google\Cloud\BigQuery\BigQueryClient;

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

        $this->app->bind(BigQueryClient::class, function () {
            return new BigQueryClient([
                'keyFilePath' => env('GCP_KEY_FILE_PATH'),
                'projectId'   => 'wise-vim-242413'       ,
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
