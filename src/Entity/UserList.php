<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserListRepository")
 */
class UserList
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userLists")
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ToDoList", inversedBy="userLists")
     */
    private ToDoList $list;

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @param ToDoList $list
     */
    public function setList(ToDoList $list): void
    {
        $this->list = $list;
    }

    /**
     * @return ToDoList
     */
    public function getList(): ToDoList
    {
        return $this->list;
    }


}
