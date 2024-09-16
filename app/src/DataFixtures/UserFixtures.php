<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Data to be seeder.
        $data = [
            ['id' => 1, 'first_name' => 'Barack', 'last_name' => 'Obama', 'address' => 'White House'],
            ['id' => 2, 'first_name' => 'Britney', 'last_name' => 'Spears', 'address' => 'America'],
            ['id' => 3, 'first_name' => 'Leonardo', 'last_name' => 'DiCaprio', 'address' => 'Titanic'],
        ];

        foreach ($data as $item) {
            $user = new User();
            $user->setId($item['id']);
            $user->setFirstName($item['first_name']);
            $user->setLastName($item['last_name']);
            $user->setAddress($item['address']);
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setUpdatedAt(new \DateTimeImmutable());
            $manager->persist($user);
        }

        $manager->flush();
    }
}
