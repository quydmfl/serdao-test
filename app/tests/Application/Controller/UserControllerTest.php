<?php

namespace App\Tests\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testShowFormAdd(): void
    {
        $client = static::createClient();
        // Request the page where the form is displayed
        $crawler = $client->request('GET', '/user');

        // Assert that the response is successful and the form is displayed
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Add user form');

        // Select the form and fill in the fields
        $form = $crawler->selectButton('Submit')->form([
            'user[firstName]' => 'John',
            'user[lastName]' => 'Doe',
            'user[address]' => '123 Main St',
        ]);

        // Submit the form
        $client->submit($form);

        // Follow the redirect
        $client->followRedirect();

        // Assert that the redirect is to the 'user_index' route and displays the updated user list
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('table');
        $this->assertSelectorTextContains('table', 'John Doe');
    }
}
