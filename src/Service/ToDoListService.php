<?php

namespace App\Service;

use App\Entity\ToDoList;
use App\Entity\UserList;
use App\Repository\ToDoListRepository;
use App\Repository\UserListRepository;
use App\Repository\UserRepository;

class ToDoListService
{


    public function __construct(
        protected UserListRepository $userList,
        protected UserRepository $userRepository,
        protected ToDoListRepository $toDoList
    ) {
    }

    public function getToDoList(int $userId): array
    {
        return $this->userList->findBy(['user' => $userId]);
    }


    public function addToDoList(int $userId, string $listName): void
    {
        $toDoList = new ToDoList();
        $toDoList->setName($listName);
        $toDoList->setCreatedAt(time());


        $this->toDoList->save($toDoList);

        $this->addNewUserToAccessList($userId, $toDoList->getId());
    }


    public function addNewUserToAccessList(int $userId, int $listId): void
    {
        $userList = new UserList();

        $user = $this->userRepository->find($userId);
        $list = $this->toDoList->findOneBy(['id' => $listId]);

        if ($user && $list) {
            $userList->setUser($user);
            $userList->setList($list);

            $this->userList->save($userList);
        }
    }

    public function getListById(int $listId): ?array
    {
        return $this->toDoList->findBy(['id' => $listId]);
    }


    public function getListWithUnFinishedTasksAndOlderThanWeek(): ?array
    {
        return $this->toDoList->getListWithUnFinishedTasksAndOlderThanWeek();
    }


    public function getUserForList(int $listId): ?array
    {
        return $this->userList->findBy(['list' => $listId]);
    }


}