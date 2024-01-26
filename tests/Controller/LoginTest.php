<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\Tools\SchemaTool;

class LoginControllerTest extends WebTestCase
{
    private $entityManager;
    private $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();

        $this->entityManager = $this->client->getContainer()
            ->get('doctrine')
            ->getManager();

        $schemaTool = new SchemaTool($this->entityManager);
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool->updateSchema($metadata);
        $schemaTool->dropDatabase();
        $schemaTool->createSchema($metadata);

        $fixtures = new \App\DataFixtures\Test\UserFixtures();
        $fixtures->load($this->entityManager);
    }

    public function testLogin()
    {
        $crawler = $this->client->request('GET', 'https://localhost:8000/login');
        $form = $crawler->filter('.login')->form([
            'user[username]' => 'test_user',
            'user[password]' => 'test_password',
        ]);

        $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isRedirect('https://localhost:8000/items'));
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testLogout()
    {
        $this->client->request('GET', 'https://localhost:8000/logout');

        $this->assertTrue($this->client->getResponse()->isRedirect('https://localhost:8000/'));

        $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}
