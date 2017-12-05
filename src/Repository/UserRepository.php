<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }


    /**
     * @param $username
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param int $id
     * @return User|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findActiveUserById(int $id): ?User
    {
        return $this->createQueryBuilder('u')
            ->where('u.active = :value')->setParameter('value', true)
            ->where('u.id = :id')->setParameter('id', $id)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
            ->getQuery()
            ->getOneOrNullResult();
    }

}
