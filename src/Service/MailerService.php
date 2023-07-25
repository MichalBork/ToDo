<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{


    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly ParameterBagInterface $parameterBag
    )
    {
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendMail(string $emailAddress, string $subject, string $content): void
    {

        $email = (new Email())->from($this->parameterBag->get('mailer_from'))
            ->to($emailAddress)
            ->subject($subject)
            ->text($content);

        $this->mailer->send($email);

    }




}