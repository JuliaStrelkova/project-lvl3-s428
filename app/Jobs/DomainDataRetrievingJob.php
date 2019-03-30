<?php


namespace PageAnalyzer\Jobs;


use DiDom\Document;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use PageAnalyzer\Model\Domain;

class DomainDataRetrievingJob extends Job
{
    /** @var Client */
    private $httpClient;
    private $domain;

    public function __construct(Domain $domain)
    {
        $this->domain = $domain;
        $this->httpClient = app(Client::class);
    }

    public function handle()
    {
        try {
            $response = $this->httpClient->get($this->domain->name);
        } catch (ConnectException $e) {
            throw new \Exception();
        }

        $body = $response->getBody()->getContents();

        $contentLengthHeaders = $response->getHeader('Content-Length');

        if (!empty($contentLengthHeaders)) {
            $contentLength = (int) $contentLengthHeaders[0];
        } else {
            $contentLength = mb_strlen($body);
        }

        $domainData = [
            'body' => $body,
            'code' => $response->getStatusCode(),
            'content_length' => $contentLength,
        ];

        $document = new Document($body);

        $h1 = $document->first('h1');
        if ($h1) {
            $domainData['h1'] = $h1->text();
        }
        $keywords = $document->find('meta[name=keywords]');
        if (count($keywords) > 0) {
            $domainData['keywords'] = $keywords[0]->attr('content');
        }

        $description = $document->find('meta[name=description]');
        if (count($description) > 0) {
            $domainData['description'] = $description[0]->attr('content');
        }

        $this->domain->update($domainData);
    }
}