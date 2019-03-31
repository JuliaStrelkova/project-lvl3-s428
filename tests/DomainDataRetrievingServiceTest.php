<?php


namespace PageAnalyzer;


use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use PageAnalyzer\Service\DomainDataRetrievingService;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;

class DomainDataRetrievingServiceTest extends TestCase
{
    public function testRetrieveDomainData()
    {
        $content = file_get_contents(__DIR__ . '/Stubs/TestDomain.html');
        $mock = new MockHandler([
            new Response(HttpResponse::HTTP_OK, ['Content-Length' => mb_strlen($content)], $content),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $service = new DomainDataRetrievingService($client);

        $domainData = $service->retrieveDomainData('https://localhost.dev');

        $this->assertEquals(HttpResponse::HTTP_OK, $domainData->getCode());
        $this->assertEquals('test description', $domainData->getDescription());
        $this->assertEquals('test keywords', $domainData->getKeywords());
        $this->assertEquals('Test heading', $domainData->getH1());
        $this->assertEquals(mb_strlen($content), $domainData->getContentLength());
        $this->assertEquals($content, $domainData->getBody());
    }

    public function testUnreachableServerRetrieveDomainData()
    {
        $mock = new MockHandler([
            new RequestException(
                "Error Communicating with Server",
                new Request('GET', 'https://localhost.dev'),
                new Response(HttpResponse::HTTP_NOT_FOUND)
            ),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $service = new DomainDataRetrievingService($client);

        $domainData = $service->retrieveDomainData('https://localhost.dev');

        $this->assertEquals(HttpResponse::HTTP_NOT_FOUND, $domainData->getCode());

        $this->assertNull($domainData->getDescription());
        $this->assertNull($domainData->getKeywords());
        $this->assertNull($domainData->getH1());
        $this->assertNull($domainData->getContentLength());
        $this->assertNull($domainData->getBody());
    }
}
