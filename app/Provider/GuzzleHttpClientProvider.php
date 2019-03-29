<?php


namespace PageAnalyzer\Provider;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\ServiceProvider;

class GuzzleHttpClientProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bindIf(
            Client::class,
            static function () {
                return new Client([RequestOptions::HTTP_ERRORS]);
            }
        );
    }
}
