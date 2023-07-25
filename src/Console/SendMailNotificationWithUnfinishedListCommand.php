<?php

namespace App\Console;

use App\Message\MailNotification;
use App\Repository\UserListRepository;
use App\Service\ToDoListService;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class SendMailNotificationWithUnfinishedListCommand extends Command
{


    public function __construct(
        private readonly ToDoListService $toDoListService,
        private LoggerInterface $logger,
        private MessageBusInterface $messageBus

    )
    {
        parent::__construct();
    }


    protected function configure(): void
    {
        $this->setName('app:send-mail-notification-with-unfinished-list')
            ->setDescription('Send mail notification with unfinished list');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $unfinishedLists = $this->toDoListService->getListWithUnFinishedTasksAndOlderThanWeek();
            foreach ($unfinishedLists as $unfinishedList) {

                $user = $this->toDoListService->getUserForList($unfinishedList['id']);
                $mailNotification = new MailNotification(
                    $user[0]->getUser()->getEmail(),
                    'Unfinished list',
                    'You have unfinished list: ' . $unfinishedList['name']
                );
                $this->messageBus->dispatch($mailNotification);
            }

        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }


}