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

    protected $player;

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function ignore($player): static
    {
        $this->player = $player;

        return $this;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $count = Player::query()
            ->whereInLineup()
            ->when($this->player, fn ($q) => $q->where('id', '!=', $this->player->id))
            ->count();

        if ($value && $count >= 11) {
            $fail('Only 11 Players can be in lineup');
        }

        $line = Line::find(Arr::get($this->data, 'line_id'));

        $countForLine = Player::query()
            ->when($line, fn ($q) => $q->whereBelongsTo($line))
            ->whereInLineup()
            ->when($this->player, fn ($q) => $q->where('id', '!=', $this->player->id))
            ->count();

        if ($line && $value && $countForLine >= $line->max_in_lineup) {
            $fail("This line can't have more than {$line->max_in_lineup} player(s) in lineup!");
        }
    }
}
