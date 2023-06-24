<?php

namespace Database\Seeders;

use App\Models\Line;
use App\Models\Player;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerSeeder extends Seeder
{
    public function run(): void
    {
        $lines = Line::all();

        $lines
            ->each(function ($line, $index) {
                match ($line->short_name) {
                    'GK' => Player::factory(1)->create(['line_id' => $line->id, 'in_lineup' => true]),
                    'DEF' => Player::factory(4)->create(['line_id' => $line->id, 'in_lineup' => true]),
                    'MDF' => Player::factory(3)->create(['line_id' => $line->id, 'in_lineup' => true]),
                    'ATK' => Player::factory(3)->create(['line_id' => $line->id, 'in_lineup' => true]),
                };
            });

        $lines
            ->each(function ($line) {
                match ($line->short_name) {
                    'GK' => Player::factory(1)->create(['line_id' => $line->id, 'in_lineup' => false]),
                    'DEF' => Player::factory(2)->create(['line_id' => $line->id, 'in_lineup' => false]),
                    'MDF' => Player::factory(2)->create(['line_id' => $line->id, 'in_lineup' => false]),
                    'ATK' => Player::factory(2)->create(['line_id' => $line->id, 'in_lineup' => false]),
                };
            });

        Player::query()->update(['shirt_number' => DB::raw('id')]);
    }
}
