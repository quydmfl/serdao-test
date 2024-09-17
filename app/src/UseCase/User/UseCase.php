<?php

namespace App\UseCase\User;

use App\Repository\UserRepositoryInterface;

abstract class UseCase
{
  protected UserRepositoryInterface $userRepository;

  public function __construct(UserRepositoryInterface $userRepository)
  {
    $this->userRepository = $userRepository;
  }
}

