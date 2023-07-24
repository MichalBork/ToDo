<?php

namespace App\Repository;

use App\Entity\UserList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserList::class);

    }

    public function save(UserList $userList): void
    {
        $this->getEntityManager()->persist($userList);
        $this->getEntityManager()->flush();
    }


}