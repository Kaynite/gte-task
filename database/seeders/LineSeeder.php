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
            ],
            [
                'name' => 'Defender',
                'short_name' => 'DEF',
            ],
            [
                'name' => 'Midfielder',
                'short_name' => 'MDF',
            ],
            [
                'name' => 'Attacker',
                'short_name' => 'ATK',
            ],
        ];

        collect($lines)->each(fn ($line) => Line::create($line));
    }
}
