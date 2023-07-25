<?php

namespace App\Message;

class MailNotification
{
    public function __construct(
        private readonly string $email,
        private readonly string $subject,
        private readonly string $content
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getContent(): string
    {
        return $this->content;
    }




}