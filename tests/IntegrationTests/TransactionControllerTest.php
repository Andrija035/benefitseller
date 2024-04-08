<?php

namespace App\Tests\IntegrationTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TransactionControllerTest extends WebTestCase
{
    public function testProcessTransactionSuccess()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/transaction',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_authority' => 'benefitseller',
                'HTTP_token' => 'testvalue'
            ],
            json_encode([
                'cardNumber' => '4859123456719012',
                'merchantId' => 1,
                'amount' => 500
            ])
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('success', $responseData);
        $this->assertTrue($responseData['success']);
    }

    public function testProcessTransactionFailAmount()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/transaction',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_authority' => 'benefitseller',
                'HTTP_token' => 'testvalue'
            ],
            json_encode([
                'cardNumber' => '4859123456719012',
                'merchantId' => 1,
                'amount' => 90000000
            ])
        );

        $this->assertEquals(500, $client->getResponse()->getStatusCode());

        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('success', $responseData);
        $this->assertFalse($responseData['success']);
    }

    public function testProcessTransactionFailToken()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/transaction',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_authority' => 'benefitseller',
                'HTTP_token' => 'wrongToken'
            ],
            json_encode([
                'cardNumber' => '4859123456719012',
                'merchantId' => 1,
                'amount' => 500
            ])
        );

        $this->assertEquals(500, $client->getResponse()->getStatusCode());

        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('success', $responseData);
        $this->assertFalse($responseData['success']);
    }

    public function testProcessTransactionFailCard()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/transaction',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_authority' => 'benefitseller',
                'HTTP_token' => 'testvalue'
            ],
            json_encode([
                'cardNumber' => '123',
                'merchantId' => 1,
                'amount' => 500
            ])
        );

        $this->assertEquals(500, $client->getResponse()->getStatusCode());

        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('success', $responseData);
        $this->assertFalse($responseData['success']);
    }

    public function testProcessTransactionFailMerchant()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/transaction',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_authority' => 'benefitseller',
                'HTTP_token' => 'testvalue'
            ],
            json_encode([
                'cardNumber' => '4859123456719012',
                'merchantId' => 999,
                'amount' => 500
            ])
        );

        $this->assertEquals(500, $client->getResponse()->getStatusCode());

        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('success', $responseData);
        $this->assertFalse($responseData['success']);
    }

    public function testProcessTransactionFailRequired()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/transaction',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_authority' => 'benefitseller',
                'HTTP_token' => 'testvalue'
            ],
            json_encode([
                'cardNumber' => '4859123456719012',
                'merchantId' => 1
            ])
        );

        $this->assertEquals(500, $client->getResponse()->getStatusCode());

        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('success', $responseData);
        $this->assertFalse($responseData['success']);
    }

    public function testProcessTransactionFailRequest()
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/api/transaction',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_authority' => 'benefitseller',
                'HTTP_token' => 'testvalue'
            ],
            json_encode([
                'cardNumber' => '4859123456719012',
                'merchantId' => 1,
                'amount' => 500
            ])
        );

        $this->assertEquals(405, $client->getResponse()->getStatusCode());

        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('success', $responseData);
        $this->assertFalse($responseData['success']);
    }
}
