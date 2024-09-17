<?php

namespace App\UseCase\User;

final class AddUseCase extends UseCase
{
  public function __invoke(string $firstName, string $lastName, string $address)
  {
    return $this->userRepository->addUser($firstName, $lastName, $address);
  }
}
