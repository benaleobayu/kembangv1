<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Day::create([
            'name' => 'Pilih Hari ...',
            'slug' => 'unknown',
            'date' => '2023-01-01'
        ]);

        Day::create([
            'name' => 'Senin',
            'slug' => 'senin',
            'date' => '2023-01-01'
        ]);

        Day::create([
            'name' => 'Selasa',
            'slug' => 'selasa',
            'date' => '2023-01-01'
        ]);
        Day::create([
            'name' => 'Rabu',
            'slug' => 'rabu',
            'date' => '2023-01-01'
        ]);
        Day::create([
            'name' => 'Kamis',
            'slug' => 'kamis',
            'date' => '2023-01-01'
        ]);
        Day::create([
            'name' => 'Jumat',
            'slug' => 'jumat',
            'date' => '2023-01-01'
        ]);
        Day::create([
            'name' => 'Sabtu',
            'slug' => 'sabtu',
            'date' => '2023-01-01'
        ]);
        Day::create([
            'name' => 'Minggu',
            'slug' => 'minggu',
            'date' => '2023-01-01'
        ]);
    }
}
