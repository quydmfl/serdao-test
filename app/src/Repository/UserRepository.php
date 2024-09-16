<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAllUsers()
    {
        return $this->createQueryBuilder('u')
            ->select('u.id', 'u.firstName', 'u.lastName', 'u.address')
            ->getQuery()
            ->getResult();
    }

    public function addUser(string $firstName, string $lastName, string $address)
    {
        $entityManager = $this->getEntityManager();

        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setAddress($address);

        $entityManager->persist($user);
        $entityManager->flush();
    }

    public function updateUser(int $id, string $firstName, string $lastName, string $address)
    {
        $entityManager = $this->getEntityManager();
        $user = $this->find($id);

        if ($user) {
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setAddress($address);
            $entityManager->flush();
        }
    }

    public function deleteUserById(int $id)
    {
        $entityManager = $this->getEntityManager();
        $user = $this->find($id);

        if ($user) {
            $entityManager->remove($user);
            $entityManager->flush();
        }
    }
}
