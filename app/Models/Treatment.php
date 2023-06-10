<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'initial_diagnoses_id', 'final_diagnoses_id', 'external_treatment'];

    public function patient(): BelongsTo {
        return $this->belongsTo(Patient::class. 'patient_id', 'id');
    }

    public function initialDiagnosis(): HasOne {
        return $this->hasOne(Diagnosis::class. 'initial_diagnoses_id', 'id');
    }

    public function finalDiagnosis(): HasOne {
        return $this->hasOne(Diagnosis::class. 'final_diagnoses_id', 'id');
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class, 'treatment_id', 'id');
    }
}
