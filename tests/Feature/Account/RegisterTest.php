<?php

namespace Tests\Feature\Account;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    protected function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_success_registration()
    {
        $mock = [
            "name" => "Test",
            "address1" => "Example address",
            "address2" => "Another Example address",
            "city" => "Boston",
            "state" => "Massachusetts(MA)",
            "country" => "USA",
            "zipCode" => "02118",
            "phoneNo1" => "555-666-7777",
            "phoneNo2" => "111-222-3333",
            "user" => [
                "firstName" => "Mike",
                "lastName" => "Chudesnov",
                "email" => $this->generateRandomString(10) . "@test-case.com",
                "password" => "simplepass",
                "passwordConfirmation" => "simplepass",
                "phone" => "000-000-0000"
            ]
        ];
        $response = $this->post(
            '/api/register',
            $mock,
            ['Content-Type' => 'application/json', 'Accept' => 'application/json']
        );

        $response->assertStatus(201);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_validation_workability()
    {
        $mock = [];
        $response = $this
            ->post(
                '/api/register',
                $mock,
                ['Content-Type' => 'application/json', 'Accept' => 'application/json']
            );

        $response->assertStatus(422);
    }
}
