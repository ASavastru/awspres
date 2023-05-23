<?php

namespace App\Controller;

use App\Service\EmailService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmailController extends AbstractController
{
    private $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * @Route("/api/send-email", name="send_email", methods={"POST"})
     */
    public function sendEmail(Request $request)
    {
        $recipient = $request->request->get('recipient');
        $subject = $request->request->get('subject');
        $message = $request->request->get('message');

        if (!$recipient || !$subject || !$message) {
            return $this->json(['error' => 'Missing parameters.'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $this->emailService->sendEmail($recipient, $subject, $message);
            return $this->json(['status' => 'Email sent successfully.']);
        } catch (\Exception $e) {
            return $this->json(['error' => 'An error occurred while sending the email.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
