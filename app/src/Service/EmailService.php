<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail(string $recipient, string $subject, string $content): void
    {
        $email = (new Email())
            ->from('your_email@example.com')
            ->to($recipient)
            ->subject($subject)
            ->text($content);

        $this->mailer->send($email);
    }
}
