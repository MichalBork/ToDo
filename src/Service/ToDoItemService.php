<?php

namespace App\Service;

use App\Entity\ListItem;
use App\Repository\ListItemRepository;
use App\Repository\ToDoListRepository;

class ToDoItemService
{

    public function __construct(
        protected ListItemRepository $toDoItemRepository,
        private readonly ToDoListRepository $toDoListRepository
    ) {
    }


    public function endTask(int $id, bool $status): void
    {
        $task = $this->toDoItemRepository->findOneBy(['id' => $id]);
        $task->setDone($status);


        $this->toDoItemRepository->update($task);
    }


    public function addTask(int $listId, string $taskName): void
    {
        $task = new ListItem();
        $task->setName($taskName);
        $task->setDone(false);
        $task->setList($this->toDoListRepository->findOneBy(['id' => $listId]));
        $this->toDoItemRepository->save($task);
    }

}