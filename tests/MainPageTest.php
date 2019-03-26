<?php

namespace PageAnalyzer;

class MainPageTest extends TestCase
{
    public function testMainPage()
    {
        $this->get('/');

        $this->assertContains(
            env('APP_NAME'),
            $this->response->getContent()
        );
    }
}
