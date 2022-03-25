<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Str;

class ExampleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_that_true_is_true()
    {
        $this->assertTrue(true);
    }


    public function testUserCreate()
    {
        $data = [
            'id' => 99999999,
            'email' => Str::random(4) . '@example.com',
            'password' => '123123123',
        ];

        $response = User::create($data);



        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
        ])->assertIsBool($response);
    }
}
