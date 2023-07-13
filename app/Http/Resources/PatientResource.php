<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            'fullname' => $this->fullname,
            'nickname' => $this->nickname,
            'birthday' => $this->birthday,
            'crono_birthday' => $this->crono_birthday,
            'state' => $this->state,
            'genre' => $this->genre,
            'nhc' => $this->nhc,
            'prediagnosis' => $this->prediagnosis
        ];
    }
}
