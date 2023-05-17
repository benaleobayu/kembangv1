<?php

namespace Database\Seeders;

use App\Models\Flowers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlowersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flowers = [
            ['code' => '-', 'name' => 'Pilih Bunga', 'price' => '0'],
            ['code' => 'SR', 'name' => 'Mawar Merah', 'price' => '75000'],
            ['code' => 'A', 'name' => 'Mawar Putih', 'price' => '75000'],
            ['code' => 'PA', 'name' => 'Mawar Pinksweet', 'price' => '75000'],
            ['code' => 'P', 'name' => 'Mawar Peach', 'price' => '75000'],
            ['code' => 'CD', 'name' => 'Mawar Candy', 'price' => '75000'],
            ['code' => 'CW', 'name' => 'Mawar Ungu', 'price' => '75000'],
            ['code' => 'Y', 'name' => 'Mawar Kuning', 'price' => '75000'],
            ['code' => 'O', 'name' => 'Mawar Orange', 'price' => '75000'],
            ['code' => 'RV', 'name' => 'Mawar Revival', 'price' => '75000'],
            ['code' => 'AC', 'name' => 'Mawar Any Colors', 'price' => '75000'],
            ['code' => 'MC', 'name' => 'Mawar Mixed Colors', 'price' => '75000']
        ];
        Flowers::insert($flowers);
    }
}
