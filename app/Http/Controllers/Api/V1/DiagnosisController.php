<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreDiagnosisRequest;
use App\Http\Requests\UpdateDiagnosisRequest;
use App\Http\Resources\DiagnosisResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Diagnosis;
use App\Models\Patient;
use App\Models\Treatment;

class DiagnosisController extends BaseController
{
    public function denverTest()
    {
        $data = json_decode(Storage::get('public/denver/denver-test.json'), true);
        return $this->sendResponse($data, 'Denver test found.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function diagnosePatient(StoreDiagnosisRequest $request, Patient $patient)
    {
        try {
            
            $diagnosis = Diagnosis::create($request->validated());
            $treatment = Treatment::create([
                'patient_id' => $patient->id,
                'initial_diagnoses_id' => $diagnosis->id,
                'current' => true
            ]);
            $patient->update([
                'state' => 'En tratamiento SJ'
            ]);

            return $this->sendResponse(new DiagnosisResource($diagnosis), 'Diagnóstico creado exitosamente.');
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde'], 500);
        }
    }

    public function dischargePatient(StoreDiagnosisRequest $request, Patient $patient, Treatment $treatment)
    {
        try {
            $diagnosis = Diagnosis::create($request->validated());
            $treatment->update([
                'final_diagnoses_id' => $diagnosis->id,
                'current' => false                
            ]);
            $patient->update([
                'state' => 'Dado de alta'
            ]);

            return $this->sendResponse(new DiagnosisResource($diagnosis), 'Diagnóstico creado exitosamente.');
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Diagnosis $diagnosis)
    {
        try {
            return $this->sendResponse(DiagnosisResource::make($diagnosis), 'Diagnóstico encontrado.');
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde'], 500);
        }
    }
}
