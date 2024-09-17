<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;
use Symfony\Component\DependencyInjection\Attribute\When;

#[When(env: 'dev')]
#[When(env: 'prod')]
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAllUsers(): array
    {
        return $this->createQueryBuilder('u')
            ->select('u.id', 'u.firstName', 'u.lastName', 'u.address')
            ->getQuery()
            ->getResult();
    }

    public function addUser(string $firstName, string $lastName, string $address): ?User
    {
        $entityManager = $this->getEntityManager();

        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setAddress($address);

        $entityManager->persist($user);
        $entityManager->flush();

        return $user;
    }

    public function updateUser(int $id, string $firstName, string $lastName, string $address): ?User
    {
        $entityManager = $this->getEntityManager();
        $user = $this->find($id);

        if ($user) {
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setAddress($address);
            $entityManager->flush();
        }

        return $user;
    }

    public function deleteUserById(?int $id): bool
    {
        $entityManager = $this->getEntityManager();
        $user = $this->find($id);

        if ($user) {
            $entityManager->remove($user);
            $entityManager->flush();

            return true;
        }

        return false;
    }
}
