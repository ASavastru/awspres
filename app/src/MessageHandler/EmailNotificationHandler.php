<?php

namespace App\MessageHandler;

use App\Message\EmailNotification;
use App\Service\EmailService;
use Symfony\Component\Messenger\AsMessageHandler;

#[AsMessageHandler]
class EmailNotificationHandler
{
    private $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function __invoke(EmailNotification $message)
    {
        $recipient = $message->getRecipient();
        $subject = $message->getSubject();
        $content = $message->getMessage();

        // Call the email service to send the email
        $this->emailService->sendEmail($recipient, $subject, $content);
    }
}
