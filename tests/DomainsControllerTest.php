<?php

namespace PageAnalyzer;

use Laravel\Lumen\Testing\DatabaseMigrations;
use PageAnalyzer\Model\Domain;
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
        $this->post(route('domains.store'), ['domain' => 'https://mail.ru']);

        $this->seeInDatabase('domains', ['name' => 'https://mail.ru']);
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
        factory(Domain::class, 15)->create();

        $this->get(route('domains.list'));
        $this->assertResponseStatus(200);
    }
}
