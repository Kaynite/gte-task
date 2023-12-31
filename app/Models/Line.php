<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Line extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_name', 'max_in_lineup'];

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }
}
