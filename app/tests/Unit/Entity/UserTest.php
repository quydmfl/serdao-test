<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
  // Skip testing create_at & update_at.
  public function testSetAndGet()
  {
    $user = new User();
    $user->setFirstName('John');
    $user->setLastName('Doe');
    $user->setAddress('123 street');

    $this->assertEquals('John', $user->getFirstName());
    $this->assertEquals('Doe', $user->getLastName());
    $this->assertEquals('123 street', $user->getAddress());
  }
}
