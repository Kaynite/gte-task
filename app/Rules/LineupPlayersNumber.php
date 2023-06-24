<?php

namespace App\Rules;

use App\Models\Line;
use App\Models\Player;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Arr;

class LineupPlayersNumber implements ValidationRule, DataAwareRule
{
    protected $data = [];

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value && Player::whereInLineup()->count() >= 11) {
            $fail('Only 11 Players can be in lineup');
        }

        $line = Line::find(Arr::get($this->data, 'line_id'));

        if ($line && Player::whereBelongsTo($line)->whereInLineup()->count() >= $line->max_in_lineup) {
            $fail("This line can't have more than {$line->max_in_lineup} player(s) in lineup!");
        }
    }
}
