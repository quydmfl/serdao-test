<?php

namespace App\UseCase\User;

use App\Repository\Fake\UserRepository;
use PHPUnit\Framework\TestCase;

class IndexCaseTest extends TestCase
{
  public function testItReturnsAllUsers()
  {
    $userRepository = new UserRepository();
    $indexUseCase = new IndexUseCase($userRepository);

    $expected = $userRepository->findAllUsers();
    $actual = $indexUseCase();

    $this->assertEquals($expected, $actual);
    $this->assertCount(count($expected), $actual);
  }
}
