<?php


namespace PageAnalyzer\Service;


use DiDom\Document;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use PageAnalyzer\Model\Domain;
use Symfony\Component\HttpFoundation\Response;

class DomainDataRetrievingService
{
    private $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function fillDomainSeoData(Domain $domain): void
    {
        try {
            $response = $this->httpClient->get($domain->name);
        } catch (RequestException $e) {
            $code = Response::HTTP_NOT_FOUND;
            if ($e->getResponse()) {
                $code = $e->getResponse()->getStatusCode();
            }
            $domain->update([
                'code' => $code,
            ]);

            return;
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
//dump($domainData);exit;
        $domain->update($domainData);
    }
}
