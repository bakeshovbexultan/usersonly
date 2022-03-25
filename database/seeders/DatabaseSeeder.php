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
        //$users = User::factory(20)->make();
        Status::factory(1)->create();
        User::factory(20)->create();
        //        \App\Models\User::factory(20)->create();
    }
}
