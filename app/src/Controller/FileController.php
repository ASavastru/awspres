<?php

namespace App\Controller;

use App\Service\S3Uploader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FileController extends AbstractController
{
    private $uploader;

    public function __construct(S3Uploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @Route("/api/upload", name="upload_file", methods={"POST"})
     */
    public function upload(Request $request)
    {
        $file = $request->files->get('file');

        if (!$file) {
            return $this->json(['error' => 'No file was uploaded.'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $url = $this->uploader->upload($file);
            return $this->json(['url' => $url]);
        } catch (\Exception $e) {
            return $this->json(['error' => 'An error occurred while uploading the file.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
