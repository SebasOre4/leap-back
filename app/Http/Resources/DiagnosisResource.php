<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiagnosisResource extends JsonResource
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
            'denver_test' => json_decode($this->denver_test),
            'recomendations' => $this->recomendations,
            'result' => $this->result,
            'evaluated_age' => $this->evaluated_age,
            'created_at' => $this->created_at
        ];
    }
}
