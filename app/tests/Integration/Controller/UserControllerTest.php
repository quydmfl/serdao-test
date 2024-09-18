<?php
namespace App\Tests\Integration\Controller;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

class UserControllerTest extends KernelTestCase
{
  public function testShowFormAdd(): void
  {
    $kernel = self::bootKernel();

    // Create a fake request with form data
    $formData = [
        'user' => [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'address' => '123 Main St',
        ],
    ];

    $fakeRequest = Request::create('/user', 'POST', $formData);

    // Handle the request
    $response = $kernel->handle($fakeRequest);

    // Assert that the response is a redirect to the 'user_index' route
    $this->assertEquals(302, $response->getStatusCode());
    $this->assertEquals('/user', $response->headers->get('Location'));
  }
}