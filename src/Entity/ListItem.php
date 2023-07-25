<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ListItemRepository")
 */
class ListItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $done;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ToDoList", inversedBy="items")
     */
    private mixed $list;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isDone(): bool
    {
        return $this->done;
    }

    /**
     * @param bool $done
     */
    public function setDone(bool $done): void
    {
        $this->done = $done;
    }

    /**
     * @return mixed
     */
    public function getList(): mixed
    {
        return $this->list;
    }

    /**
     * @param mixed $list
     */
    public function setList(mixed $list): void
    {
        $this->list = $list;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


}
