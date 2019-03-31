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
        $this->post(route('domains.store'), ['domain' => 'https://localhost.dev']);

        $this->seeInDatabase('domains', ['name' => 'https://localhost.dev', 'code' => Response::HTTP_NOT_FOUND]);
    }

    public function testFailAddingEmptyDomain()
    {
        $this->post(route('domains.store'), ['domain' => null]);

        $this->notSeeInDatabase('domains', ['name' => null]);
    }

    public function testFailAddingInvalidDomain()
    {
        $this->post(route('domains.store'), ['domain' => 'bad.domain']);

        $this->notSeeInDatabase('domains', ['name' => 'bad.domain']);
    }

    public function testDomainsList()
    {
        factory(Domain::class, 15)->create();

        $this->get(route('domains.list'));
        $this->assertResponseStatus(200);
    }
}
