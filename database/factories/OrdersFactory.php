<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrdersFactory extends Factory
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
            'notes' => Str::random(15),
            'day_id' => mt_rand(1,8),
            'pic' => 'Priska'
        ];
    }
}
