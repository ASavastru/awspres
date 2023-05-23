<?php

namespace App\Service;

use Aws\S3\S3Client;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class S3Uploader
{
    private $s3Client;
    private $bucketName;

    public function __construct(S3Client $s3Client, $bucketName)
    {
        $this->s3Client = $s3Client;
        $this->bucketName = $bucketName;
    }

    public function upload(UploadedFile $file): string
    {
        $key = uniqid() . '.' . $file->getClientOriginalExtension();

        $result = $this->s3Client->putObject([
            'Bucket' => $this->bucketName,
            'Key' => $key,
            'Body' => fopen($file->getPathname(), 'rb'),
            'ACL' => 'public-read',
        ]);

        return $result['ObjectURL'];
    }
}
