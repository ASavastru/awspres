<?php

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FileControllerTest extends WebTestCase
{
    public function testUpload()
    {
        $client = static::createClient();

        // Create a sample file to upload
        $file = tempnam(sys_get_temp_dir(), 'test');
        file_put_contents($file, 'Sample content');

        $client->request(
            'POST',
            '/api/upload',
            [],
            ['file' => new \Symfony\Component\HttpFoundation\File\UploadedFile($file, 'test.txt')]
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // Clean up the sample file
        unlink($file);
    }
}
