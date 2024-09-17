<?php

namespace App\UseCase\User;

use App\Repository\Fake\UserRepository;
use PHPUnit\Framework\TestCase;

class DeleteUseCaseTest extends TestCase
{
  public function testItRemoveUser()
  {
    $userRepository = new UserRepository();
    $deleteUseCase = new DeleteUseCase($userRepository);
    $user = $userRepository->addUser(4, 'John', 'Doe', '123 street');
    $deleteUseCase($user->getId());
    $this->assertNull($userRepository->findUserById($user->getId()));
  }
}