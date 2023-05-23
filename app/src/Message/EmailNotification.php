<?php

namespace App\Message;

class EmailNotification
{
    private $recipient;
    private $subject;
    private $message;

    public function __construct(string $recipient, string $subject, string $message)
    {
        $this->recipient = $recipient;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
