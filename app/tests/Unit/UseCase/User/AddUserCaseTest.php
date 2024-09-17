<?php

namespace App\UseCase\User;

use App\Entity\User;
use App\Repository\Fake\UserRepository;
use PHPUnit\Framework\TestCase;

class AddUserCaseTest extends TestCase
{
  public function testItAddsUser()
  {
    $userRepository = new UserRepository();
    $addUserCase = new AddUseCase($userRepository);
    $user = $addUserCase('John', 'Doe', '123 street');
    $this->assertInstanceOf(User::class, $user);

    $actual = $userRepository->findUserById($user->getId());
    $this->assertEquals($user, $actual);
  }
}