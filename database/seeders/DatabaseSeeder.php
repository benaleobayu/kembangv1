<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Rider;
use App\Models\Langganan;
use App\Models\Orders;
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


        Rider::Factory()->count(15)->create();
        Langganan::Factory()->count(45)->create();
        Orders::Factory()->count(45)->create();

        $this->call(RegencySeeder::class);
        $this->call(FlowersSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(DaySeeder::class);
     
    }
}
