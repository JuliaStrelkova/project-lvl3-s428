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

        $this->assertResponseOk();
    }

    public function testAddNewDomain()
    {
        $this->post('/domains', ['domain' => 'https://test.domain.name']);

        $this->seeInDatabase('domains', ['name' => 'https://test.domain.name']);
    }

    public function testFailAddingEmptyDomain()
    {
        $this->post('/domains', ['domain' => null]);

        $this->notSeeInDatabase('domains', ['name' => null]);
        $this->assertResponseStatus(Response::HTTP_FOUND);
    }

    public function testFailAddingInvalidDomain()
    {
        $this->post('/domains', ['domain' => 'bad.domain']);

        $this->notSeeInDatabase('domains', ['name' => 'bad.domain']);
        $this->assertResponseStatus(Response::HTTP_FOUND);
    }
}
