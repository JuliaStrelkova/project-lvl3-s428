<?php

namespace PageAnalyzer;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Symfony\Component\HttpFoundation\Response;

class DomainsControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testMainPage()
    {
        $this->get('/');

        $this->assertResponseStatus(Response::HTTP_MOVED_PERMANENTLY);
    }

    public function testDomainsPage()
    {
        $this->get('/domains');

        $this->assertResponseStatus(Response::HTTP_OK);
    }

    public function testAddNewDomain()
    {
        $this->post('/domains', ['domain' => 'test.domain.name']);

        $this->seeInDatabase('domains', ['name' => 'test.domain.name']);
    }

    public function testFailAddingNewDomain()
    {
        $this->post('/domains', ['domain' => null]);

        $this->assertContains('The domain field is required', $this->response->getContent());
    }
}
