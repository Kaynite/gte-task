<?php

namespace App\Http\Requests;

use App\Rules\LineupPlayersNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'line_id' => ['required', 'exists:lines,id'],
            'shirt_number' => ['required', 'numeric', 'between:1,99', Rule::unique('players', 'shirt_number')->ignore($this->player)],
            'in_lineup' => ['required', 'boolean', (new LineupPlayersNumber())->ignore($this->player)],
        ];
    }
}
