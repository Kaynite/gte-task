<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'shirt_number' => $this->shirt_number,
            'line_id' => $this->line_id,
            'in_lineup' => $this->in_lineup,
            'line' => LineResource::make($this->whenLoaded('line')),
        ];
    }
}
