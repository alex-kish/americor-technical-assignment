<?php

declare(strict_types=1);

namespace Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class HealthCheckActionTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, '/health-check');

        $this->assertResponseIsSuccessful();
        $result = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals($result['status'], 'ok');
    }
}
