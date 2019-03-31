<?php


namespace PageAnalyzer\Provider;


use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use PageAnalyzer\Service\DomainDataRetrievingService;

class DomainDataRetrievingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bindIf(
            DomainDataRetrievingService::class,
            static function () {
                return new DomainDataRetrievingService(app(Client::class));
            }
        );
    }
}
