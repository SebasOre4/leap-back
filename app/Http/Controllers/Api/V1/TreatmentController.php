<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreTreatmentRequest;
use App\Http\Requests\UpdateTreatmentRequest;
use App\Http\Resources\TreatmentResource;
use App\Models\Patient;
use App\Models\Treatment;

class TreatmentController extends BaseController
{
    public function currentTreatment(Patient $patient)
    {
        $currentTreatment = Treatment::where('patient_id', $patient->id)->where('current', true)->firstOrFail();
            return $this->sendResponse(new TreatmentResource($currentTreatment), 'Tratamiento actual creado exitosamente.');
        try {
            
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde', 'msg' => $th], 500);
        }
    }

    public function updateTreatment(UpdateTreatmentRequest $request, Treatment $treatment){
        $treatment->update($request->validated());

        return $this->sendResponse(new TreatmentResource($treatment), 'Datos de tratamiento actualizados.');
    }

    public function treatmentHistory(Patient $patient)
    {
        try {
            return TreatmentResource::collection(Treatment::where('patient_id', $patient->id)->where('current', false)->orderBy('created_at', 'DESC')->paginate(10));
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde', 'msg' => $th], 500);
        }
    }
}
