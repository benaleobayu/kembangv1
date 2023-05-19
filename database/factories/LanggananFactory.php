<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Langganan>
 */
class LanggananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'address' => fake()->streetAddress(),
            'regencies_id' => mt_rand(1,44),
            'phone' => fake()->phoneNumber(),
            // 'flowers_id' => mt_rand(1,11),
            // 'total' => mt_rand(1,4),
            'notes' => Str::random(15),
            'day_id' => mt_rand(1,7),
            'pic' => 'Priska'
        ];
    }
}
