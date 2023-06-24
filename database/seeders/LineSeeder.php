<?php

namespace Database\Seeders;

use App\Models\Line;
use Illuminate\Database\Seeder;

class LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lines = [
            [
                'name' => 'Goalkeeper',
                'short_name' => 'GK',
                'max_in_lineup' => 1,
            ],
            [
                'name' => 'Defender',
                'short_name' => 'DEF',
                'max_in_lineup' => 10,
            ],
            [
                'name' => 'Midfielder',
                'short_name' => 'MDF',
                'max_in_lineup' => 10,
            ],
            [
                'name' => 'Attacker',
                'short_name' => 'ATK',
                'max_in_lineup' => 10,
            ],
        ];

        collect($lines)->each(fn ($line) => Line::create($line));
    }
}
