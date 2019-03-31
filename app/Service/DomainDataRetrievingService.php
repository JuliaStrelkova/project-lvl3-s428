<?php


namespace PageAnalyzer\Service;


use DiDom\Document;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use PageAnalyzer\Dto\DomainData;
use Symfony\Component\HttpFoundation\Response;

class DomainDataRetrievingService
{
    private $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function retrieveDomainData(string $domain): DomainData
    {
        $domainData = new DomainData();
        try {
            $response = $this->httpClient->get($domain);
        } catch (RequestException $e) {
            $code = Response::HTTP_NOT_FOUND;
            if ($e->getResponse()) {
                $code = $e->getResponse()->getStatusCode();
            }
            $domainData->setCode($code);

            return $domainData;
        }

        $body = $response->getBody()->getContents();
        $contentLengthHeaders = $response->getHeader('Content-Length');

        if (!empty($contentLengthHeaders)) {
            $domainData->setContentLength((int) $contentLengthHeaders[0]);
        } else {
            $domainData->setContentLength(mb_strlen($body));
        }

        $domainData->setCode($response->getStatusCode());
        $domainData->setBody($body);

        $document = new Document($body);

        $h1 = $document->first('h1');
        if ($h1) {
            $domainData->setH1($h1->text());
        }
        $keywords = $document->find('meta[name=keywords]');
        if (count($keywords) > 0) {
            $domainData->setKeywords($keywords[0]->attr('content'));
        }

        $description = $document->find('meta[name=description]');
        if (count($description) > 0) {
            $domainData->setDescription($description[0]->attr('content'));
        }

        return $domainData;
    }
}
