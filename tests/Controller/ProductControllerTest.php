<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductControllerTest extends WebTestCase
{
    private $client;
    private $url;
    public function setUp(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $this->client = static::createClient();
        $this->url = 'http://localhost:8001/products';
        parent::setUp();
    }

    public function testShowProductById()
    {
        $result = $this->client->request('GET', $this->url . '/BA-01');
        self::assertNotNull($result);
        $response = $this->client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);
        self::assertSame('BA-01', $responseData['sku']);
    }

    public function testShowExceptionWithWrongProductId()
    {
        $result = $this->client->request('GET', $this->url . '/TO-0213');
        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
    }

    public function testShowAllProducts()
    {
        $result = $this->client->request('GET', $this->url);
        self::assertNotNull($result);
        $response = $this->client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);
        self::assertNotNull($responseData['total_products']);
    }
}
