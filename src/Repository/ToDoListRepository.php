<?php

namespace App\Repository;

use App\Entity\ToDoList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ToDoListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ToDoList::class);
    }


    public function save(ToDoList $toDoList): void
    {
        $this->getEntityManager()->persist($toDoList);
        $this->getEntityManager()->flush();
    }

    public function delete(ToDoList $toDoList): void
    {
        $this->getEntityManager()->remove($toDoList);
        $this->getEntityManager()->flush();
    }


    public function getListWithUnFinishedTasksAndOlderThanWeek(): ?array
    {
        return $this->createQueryBuilder('l')
            ->select('l.name, l.createdAt', 'l.id')
            ->leftJoin('l.items', 'i', 'WITH', 'i.done = false')
            ->groupBy('l.id')
            ->having('COUNT(i.id) > 0')
            ->andWhere('l.createdAt < :weekAgo')
            ->setParameter('weekAgo', time() - 604800)
            ->getQuery()
            ->getResult();
    }


}
