<?php

namespace App\MessageHandler;

use App\Message\MailNotification;
use App\Service\MailerService;
use App\Service\ToDoListService;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class MailNotificationHandler
{

    public function __construct(
        private readonly MailerService $mailerService,
        private readonly ToDoListService $toDoListService
    )
    {
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function __invoke(MailNotification $mailNotification): void
    {
        $this->mailerService->sendMail(
            $mailNotification->getEmail(),
            $mailNotification->getSubject(),
            $mailNotification->getContent()
        );
    }


}