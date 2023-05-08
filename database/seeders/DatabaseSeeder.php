<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Flowers;
use App\Models\User;
use App\Models\Rider;
use App\Models\Langganan;
use App\Models\Orders;
use App\Models\UserRoles;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // User::Factory()->count(55)->create();

        User::factory()->create([
            'name' => 'admin',
            'username' => 'admin',
            'roles_id' => mt_rand(1,3),
            'email' => 'admin@brandingku.com',
            'password' => bcrypt('password')
        ]);
        UserRoles::factory()->create([
            'name' => 'admin'
        ]);
        UserRoles::factory()->create([
            'name' => 'officer'
        ]);
        UserRoles::factory()->create([
            'name' => 'user'
        ]);
        

        Rider::Factory()->count(15)->create();
        Langganan::Factory()->count(45)->create();
        Orders::Factory()->count(45)->create();

     
    }
}
