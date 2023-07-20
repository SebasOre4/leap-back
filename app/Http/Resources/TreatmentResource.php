<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentResource extends JsonResource
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
            'patient_id' => $this->patient_id,
            'initial_diagnoses_id' => $this->initial_diagnoses_id,
            'initial_diagnosis' => new DiagnosisResource($this->initialDiagnosis),
            'final_diagnosis_id' => $this->final_diagnoses_id,
            'final_diagnosis' => new DiagnosisResource($this->finalDiagnosis),
            'external_treatment' => json_decode($this->external_treatment),
            'current' => $this->current,
        ];
    }
}
