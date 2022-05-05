<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        User::factory(1)->create([
            'id' => 1,
            'username' => 'John Vance',
            'email' => 'johnvance@example.com',
            'profession' => 'Doctor',
            'phone_number' => '+1 (970) 357-9097',
            'address' => '431 Eveline Trail Apt. 085 Tessside, RI 16481-3261',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'role' => 'user',
        ]);
        $this->assertDatabaseHas('users', [
            'username' => 'John Vance',
            'email' => 'johnvance@example.com',
            'profession' => 'Doctor',
            'phone_number' => '+1 (970) 357-9097',
            'address' => '431 Eveline Trail Apt. 085 Tessside, RI 16481-3261',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'role' => 'user',
        ]);
    }

//    public function test_user_can_be_deleted()
//    {
//        User::factory(1)->create([
//            'id' => 1,
//            'username' => 'John Vance',
//            'email' => 'johnvance@example.com',
//            'profession' => 'Doctor',
//            'phone_number' => '+1 (970) 357-9097',
//            'address' => '431 Eveline Trail Apt. 085 Tessside, RI 16481-3261',
//            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
//            'role' => 'user',
//        ]);
//        $this->assertDatabaseHas('users', [
//            'username' => 'John Vance',
//            'email' => 'johnvance@example.com',
//            'profession' => 'Doctor',
//            'phone_number' => '+1 (970) 357-9097',
//            'address' => '431 Eveline Trail Apt. 085 Tessside, RI 16481-3261',
//            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
//            'role' => 'user',
//        ]);
//    }
}
