<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmailControllerTest extends WebTestCase
{
    public function testSendEmail()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/send-email',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'recipient' => 'test@example.com',
                'subject' => 'Test Subject',
                'message' => 'Test Message'
            ])
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
