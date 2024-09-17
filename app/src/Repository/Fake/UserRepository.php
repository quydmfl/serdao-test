<?php

namespace App\Repository\Fake;

use App\Entity\User;
use App\Repository\UserRepositoryInterface;
use Symfony\Component\DependencyInjection\Attribute\When;

#[When(env: 'test')]
class UserRepository implements UserRepositoryInterface
{
  private array $users = [];

  public function __construct()
  {
    $this->users = [
      new User(1, 'John', 'Doe', '123 Main St'),
      new User(2, 'Jane', 'Doe', '456 Oak Ave'),
    ];
  }

  public function findAllUsers(): array
  {
    return $this->users;
  }

  public function addUser(string $firstName, string $lastName, string $address): ?User
  {
    $user = new User(count($this->users) + 1, $firstName, $lastName, $address);
    $this->users[] = $user;
    return $user;
  }

  public function findUserById(?int $id): ?User
  {
    return $this->users[array_search($id, array_column($this->users, 'id'))] ?? null;
  }

  public function updateUser(int $id, string $firstName, string $lastName, string $address): ?User 
  {
    $updatedUser = null;
    $this->users = array_map(function (User $user) use ($id, $firstName, $lastName, $address, &$updatedUser) {
      if ($user->getId() === $id) {
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setAddress($address);
        $updatedUser = $user;
      }
      return $user;
    }, $this->users);
    return $updatedUser;
  }

  public function deleteUserById(?int $id): bool {
    $this->users = array_filter($this->users, function (User $user) use ($id) {
      return $user->getId() !== $id;
    });

    return count($this->users) !== count(array_filter($this->users, function (User $user) use ($id) {
      return $user->getId() === $id;
    }));
  }
}