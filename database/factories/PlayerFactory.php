<?php

namespace Database\Factories;

use App\Models\Line;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'shirt_number' => fake()->unique()->numberBetween(1, 99),
            'in_lineup' => fake()->boolean(),
            'line_id' => Line::factory(),
        ];
    }
}
