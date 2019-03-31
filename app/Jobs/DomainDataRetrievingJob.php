<?php


namespace PageAnalyzer\Jobs;


use PageAnalyzer\Model\Domain;
use PageAnalyzer\Service\DomainDataRetrievingService;

class DomainDataRetrievingJob extends Job
{
    /** @var DomainDataRetrievingService */
    private $domainDataRetrievingService;
    private $domain;

    public function __construct(Domain $domain)
    {
        $this->domain = $domain;
        $this->domainDataRetrievingService = app(DomainDataRetrievingService::class);
    }

    public function handle()
    {
        $this->domainDataRetrievingService->fillDomainSeoData($this->domain);
    }
}
