<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Status::factory(1)->create(['status_condition' => 'Offline']);
        Status::factory(1)->create(['status_condition' => 'Online']);
        Status::factory(1)->create(['status_condition' => 'Away']);
        User::factory(20)->create();
    }
}
