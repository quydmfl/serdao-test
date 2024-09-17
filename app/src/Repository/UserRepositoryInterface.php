<?php

namespace App\Repository;

use App\Entity\User;

interface UserRepositoryInterface
{
  public function findAllUsers(): array;
  public function addUser(string $firstName, string $lastName, string $address): ?User;
  public function updateUser(int $id, string $firstName, string $lastName, string $address): ?User;
  public function deleteUserById(?int $id): bool;
}
