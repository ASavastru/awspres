<?php

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JobQueueControllerTest extends WebTestCase
{
    public function testDispatchJob()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/dispatch-job',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'data' => 'Sample job data'
            ])
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
