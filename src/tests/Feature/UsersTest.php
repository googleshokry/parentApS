<?php

namespace Tests\Feature;

use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_filter_by_status_code()
    {
        $response = $this->get('/api/users/');
        $response->assertStatus(200);

        $response->assertJsonCount(5, 'data');
    }

    public function testApiResponseContainsExpectedFields()
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'current_page',
            'data' => [
                '*' => [
                    'parentEmail',
                    'amount',
                    'currency',
                    'status',
                    'created_at',
                    'id'
                ]
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links' => [
                '*' => [
                    'url',
                    'label',
                    'active'
                ]
            ],
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ]);
    }


    public function testAllItemsHaveDeclineStatus()
    {
        $response = $this->get('/api/users?statusCode=decline');

        $response->assertStatus(200);
        $data = $response->json()['data'];
        foreach ($data as $item) {
            $this->assertEquals('decline', $item['status']);
        }
    }

    public function testAllItemsHaveAuthorisedStatus()
    {
        $response = $this->get('/api/users?statusCode=authorised');

        $response->assertStatus(200);
        $data = $response->json()['data'];
        foreach ($data as $item) {
            $this->assertEquals('authorised', $item['status']);
        }
    }

    public function testAllItemsHaveRefundedStatus()
    {
        $response = $this->get('/api/users?statusCode=refunded');

        $response->assertStatus(200);
        $data = $response->json()['data'];
        foreach ($data as $item) {
            $this->assertEquals('refunded', $item['status']);
        }
    }

    public function testAllItemsHaveCurrancyUSD()
    {
        $response = $this->get('/api/users?currency=USD');

        $response->assertStatus(200);
        $data = $response->json()['data'];
        foreach ($data as $item) {
            $this->assertEquals('USD', $item['currency']);
        }
    }
    public function testAllItemsHaveCurrancyAED()
    {
        $response = $this->get('/api/users?currency=AED');

        $response->assertStatus(200);
        $data = $response->json()['data'];
        foreach ($data as $item) {
            $this->assertEquals('AED', $item['currency']);
        }
    }

    public function testAllItemsHaveAmountbetweenRange()
    {
        $response = $this->get('/api/users?balanceMin=100&balanceMax=200');

        $response->assertStatus(200);
        $data = $response->json()['data'];
        foreach ($data as $item) {
            $this->assertGreaterThanOrEqual(100, $item['amount']);
            $this->assertLessThanOrEqual(200, $item['amount']);
        }
    }

}
