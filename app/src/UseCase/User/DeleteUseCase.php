<?php

namespace App\UseCase\User;

final class DeleteUseCase extends UseCase
{
  public function __invoke(?int $id)
  {
    return $this->userRepository->deleteUserById($id);
  }
}
