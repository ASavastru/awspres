<?php

namespace App\Controller;

use App\Message\JobMessage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;

class JobQueueController extends AbstractController
{
    private $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @Route("/api/dispatch-job", name="dispatch_job", methods={"POST"})
     */
    public function dispatchJob(Request $request)
    {
        $jobData = $request->request->get('data');

        if (!$jobData) {
            return $this->json(['error' => 'No job data provided.'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $message = new JobMessage($jobData);
            $this->bus->dispatch($message);

            return $this->json(['status' => 'Job dispatched successfully.']);
        } catch (\Exception $e) {
            return $this->json(['error' => 'An error occurred while dispatching the job.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
