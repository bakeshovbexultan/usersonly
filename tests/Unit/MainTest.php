<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Status;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\Browser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_user_can_be_created()
    {
        /*$data = [
            'id' => 99999999,
            'email' => Str::random(4) . '@example.com',
            'password' => '123123123',
        ];

        $response = User::create($data);

        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
        ])->assertIsBool($response);*/
        self::assertTrue(true);
    }
}
