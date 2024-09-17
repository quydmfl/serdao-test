<?php

namespace App\UseCase\User;

final class IndexUseCase extends UseCase
{
  public function __invoke(): array
  {
    return $this->userRepository->findAllUsers();
  }
}
  