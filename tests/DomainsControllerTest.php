<?php

namespace PageAnalyzer;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Symfony\Component\HttpFoundation\Response;

class DomainsControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testMainPage()
    {
        $this->get(route('index'));

        $this->assertResponseOk();
    }

    public function testAddNewDomain()
    {
        $this->post(route('domains.store'), ['domain' => 'https://test.domain.name']);

        $this->seeInDatabase('domains', ['name' => 'https://test.domain.name']);
    }

    public function testFailAddingEmptyDomain()
    {
        $this->post(route('domains.store'), ['domain' => null]);

        $this->notSeeInDatabase('domains', ['name' => null]);
        $this->assertResponseStatus(Response::HTTP_FOUND);
    }

    public function testFailAddingInvalidDomain()
    {
        $this->post(route('domains.store'), ['domain' => 'bad.domain']);

        $this->notSeeInDatabase('domains', ['name' => 'bad.domain']);
        $this->assertResponseStatus(Response::HTTP_FOUND);
    }

    public function testDomainsList()
    {
        factory('PageAnalyzer\Domain', 5)->create();

        $response = $this->get(route('domains.list'));
        $response->assertResponseStatus(200);
    }
}
