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

    public function testDomainsList()
    {
        $domains = [
            'https://ru.hexlet.io',
            'https://hh.ru',
            'https://vk.com',
            'https://lumen.laravel.com',
            'https://github.com',
            'https://packagist.org',
            'https://dashboard.heroku.com',
            'https://travis-ci.org',
            'https://stepik.org',
            'https://geekbrains.ru',
            'https://habr.com',
            'https://moikrug.ru',
            'https://mail.google.com',
            'https://www.ratatype.com',
            'https://pastebin.com'
        ];
        foreach ($domains as $domain) {
            $this->post('/domains', ['domain' => $domain]);
        }
        $this->get('/domains?page=1');
        $domainsPage = $this->response->getContent();

        $this->assertContains('https://pastebin.com', $domainsPage);
        $this->assertContains('https://packagist.org', $domainsPage);
        $this->assertNotContains('https://github.com', $domainsPage);

        $this->get('/domains?page=2');
        $domainsPage = $this->response->getContent();

        $this->assertContains('https://ru.hexlet.io', $domainsPage);
        $this->assertContains('https://github.com', $domainsPage);
    }
}
