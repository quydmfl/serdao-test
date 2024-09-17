<?php
namespace App\Tests\Integration\Controller;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class UserControllerTest extends KernelTestCase
{

  public function testShowFormAdd(): void
  {
    $kernel = self::bootKernel();
    $fakeRequest = Request::create('/user', 'POST');

    $response = $kernel->handle($fakeRequest, HttpKernelInterface::MAIN_REQUEST, false);
    $this->assertEquals(302, $response->getStatusCode());
  }
}