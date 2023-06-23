<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Line>
 */
class LineFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'short_name' => Str::upper(fake()->lexify('???')),
        ];
    }
}
