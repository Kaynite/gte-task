<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Player extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'line_id', 'shirt_number', 'in_lineup'];

    protected $casts = [
        'in_lineup' => 'boolean',
    ];

    public function line(): BelongsTo
    {
        return $this->belongsTo(Line::class);
    }

    public function scopeWhereInLineup(Builder $query): Builder
    {
        return $query->where('in_lineup', true);
    }
}
